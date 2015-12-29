<?php
/**
 * This file is part of ESputnik API connector
 *
 * @package ESputnik
 * @license MIT
 * @author Dmytro Kulyk <lnkvisitor.ts@gmail.com>
 */

namespace ESputnik;
use ESputnik\Types\SubscribeContact;

/**
 * Class ESputnik
 *
 * @link http://esputnik.com.ua/api/application.wadl
 */
class ESputnik
{
    /**
     * Global ESputnik instance
     *
     * @var ESputnik
     */
    static protected $id;

    /**
     * Get global/initialize ESputnik instance
     *
     * @param null $user
     * @param null $password
     * @return ESputnik
     */
    static public function id($user = null, $password = null)
    {
        if (static::$id === null) {
            static::$id = new static($user, $password);
        }
        return static::$id;
    }

    /**
     * cURL handle
     *
     * @var resource
     */
    protected $curl;

    /**
     * Last response http code
     *
     * @var int
     */
    protected $httpCode;

    /**
     * Last response body
     *
     * @var string
     */
    protected $httpResponse;

    /**
     * ESputnik constructor
     *
     * @param string $user
     * @param string $password
     */
    public function __construct($user, $password)
    {
        $this->curl = curl_init();
        curl_setopt_array($this->curl, array(
            CURLOPT_HEADER         => true,
            CURLOPT_HTTPHEADER     => array(
                'Accept: application/json',
                'Content-Type: application/json'
            ),
            CURLOPT_USERPWD        => $user . ':' . $password,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 2
        ));
    }

    /**
     * Get the version of the protocol.
     *
     * @return Types\Version
     * @throws ESException
     */
    public function getVersion()
    {
        return new Types\Version($this->request('GET', 'version'));
    }

    /**
     * Get a list of directories.
     *
     * @return Types\AddressBook
     * @throws ESException
     */
    public function getAddressBooks()
    {
        $response = $this->request('GET', 'addressbooks');
        return new Types\AddressBook($response['addressBook']);
    }

    /**
     * Get the balance of the organization.
     *
     * @return Types\Balance
     * @throws ESException
     */
    public function getUserOrganisationBalance()
    {
        $response = $this->request('GET', 'balance');
        return new Types\Balance($response['addressBook']);
    }

    /**
     * Get statistics sms-mailing.
     *
     * @param int $offset
     * @param int $limit
     * @return Types\CallOut[]
     * @throws ESException
     */
    public function getCallOutsSms($offset = 0, $limit = 10)
    {
        $response = $this->request('GET', 'callouts/sms', array(
            'startindex' => $offset + 1,
            'maxrows'    => $limit
        ));

        return array_map(function ($row) {
            return new Types\CallOut($row);
        }, $response);
    }

    /**
     * Search for contacts.
     *
     * @param int $offset
     * @param int $limit
     * @param array $params
     * @return Types\Contacts
     * @throws ESException
     */
    public function searchContacts($offset = 0, $limit = 500, array $params = array())
    {
        $response = $this->request('GET', 'contacts', array_merge($params, array(
            'startindex' => $offset + 1,
            'maxrows'    => $limit
        )), null, $headers);

        return new Types\Contacts(array(
            'totalCount' => $headers['TotalCount'],
            'contacts'   => $response
        ));
    }

    /**
     * Add/update contacts.
     *
     * @param Types\ContactsBulkUpdate $contacts
     * @return mixed
     * @throws ESException
     * @todo untested
     */
    public function contactsBulkUpdate(Types\ContactsBulkUpdate $contacts)
    {
        return $this->request('POST', 'contacts', array(), $contacts);
    }

    /**
     * Get an email to the contact ID.
     *
     * @param int[] $ids
     * @return mixed
     * @throws ESException
     * @todo untested
     */
    public function getContactEmails(array $ids)
    {
        $response = $this->request('GET', 'contacts/email', array('ids' => implode(',', $ids)));

        return array_reduce($response['results'], function ($result, $item) {
            $result[$item['contactId']] = $item['email'];
            return $result;
        }, array());
    }

    /**
     * Get contact.
     *
     * @param int $id
     * @return Types\Contact
     * @throws ESException
     */
    public function getContact($id)
    {
        $response = $this->request('GET', 'contact/' . $id);

        if ($this->httpCode === 404) {
            return null;
        }

        return new Types\Contact($response);
    }

    /**
     * Add contact.
     *
     * @param Types\Contact $contact
     * @return boolean;
     */
    public function addContact(Types\Contact $contact)
    {
        $result = $this->request('POST', 'contact', array(), $contact);
        if (is_array($result) && array_key_exists('id', $result)) {
            $contact->id = $result['id'];
            return true;
        }
        return false;
    }

    /**
     * Update contact.
     *
     * @param Types\Contact $contact
     * @return boolean
     */
    public function updateContact(Types\Contact $contact)
    {
        $response = $this->request('PUT', 'contact/' . $contact->id, array(), $contact);

        if ($this->httpCode === 404) {
            return false;
        }

        return $response !== false;
    }

    /**
     * Subscribe contact
     *
     * @param SubscribeContact $subscribeContact
     * @return bool
     * @throws ESException
     */
    public function subscribeContact(SubscribeContact $subscribeContact)
    {
        $response = $this->request('POST', 'contact/subscribe', array(), $subscribeContact);
        if ($this->httpCode === 404) {
            return false;
        }

        return $response !== false;
    }

    /**
     * Remove contact.
     *
     * @param int $contact
     * @return boolean
     */
    public function deleteContact($contact)
    {
        if ($contact instanceof Types\Contact) {
            $contact = $contact->id;
        }

        $response = $this->request('DELETE', 'contact/' . $contact);

        if ($this->httpCode === 404) {
            return false;
        }

        return $response !== false;
    }

    /**
     * Add email-in to the list unsubscribe.
     *
     * @param string[] $emails
     * @return bool
     * @throws ESException
     * @todo untested
     */
    public function addToUnsubscribed(array $emails)
    {
        return $this->request('POST', 'emails/unsubscribed/add', array(), array('emails' => $emails)) !== false;
    }

    /**
     * Remove email-s unsubscribe from the list.
     *
     * @param string[] $emails
     * @return bool
     * @throws ESException
     * @todo untested
     */
    public function deleteFromUnsubscribed(array $emails)
    {
        return $this->request('POST', 'emails/unsubscribed/delete', array(), array('emails' => $emails)) !== false;
    }

    /**
     * Add New Event.
     *
     * @param Types\EventDto $event
     * @return boolean
     * @throws ESException
     * @todo untested
     */
    public function registerEvent(Types\EventDto $event)
    {
        return $this->request('POST', 'event', array(), $event) !== false;
    }

    /**
     * @param int $eventTypeId
     * @param int $start
     * @param int $end
     * @return todo
     * @throws ESException
     * @todo
     */
    public function resendEvents($eventTypeId, $start, $end)
    {
        $this->request('GET', 'event', array(
            'eventTypeId' => $eventTypeId,
            'start'       => $start,
            'end'         => $end
        ));
    }

    /**
     * Search groups.
     *
     * @param string $name
     * @param int $offset
     * @param int $limit
     * @return Types\Group[]
     * @throws ESException
     */
    public function searchGroups($name = '', $offset = 0, $limit = 500)
    {
        $response = $this->request('GET', 'groups', array(
            'startindex' => $offset + 1,
            'maxrows'    => $limit,
            'name'       => $name
        ));

        return array_map(function ($group) {
            return new Types\Group($group);
        }, $response);
    }

    /**
     * Search from all contacts in the group.
     *
     * @param int|Types/Group $group
     * @param int $offset
     * @param int $limit
     * @return Types\Contacts
     * @throws ESException
     */
    public function getGroupContacts($group, $offset = 0, $limit = 500)
    {
        if ($group instanceof Types\Group) {
            $group = $group->id;
        }

        $response = $this->request('GET', 'group/' . $group . '/contacts', array(
            'startindex' => $offset + 1,
            'maxrows'    => $limit
        ), null, $headers);

        return new Types\Contacts(array(
            'totalCount' => $headers['TotalCount'],
            'contacts'   => $response
        ));
    }

    public function sendEmail()
    {
        // /v1/message/email	POST
    }

    public function getInstantEmailStatus()
    {
        // /v1/message/email/status	GET
    }

    /**
     * Add email-message.
     *
     * @param Types\EmailMessage $message
     * @return boolean
     * @throws ESException
     */
    public function addEmail(Types\EmailMessage $message)
    {
        $response = $this->request('POST', 'messages/email', array(), $message);

        if (is_array($response) && array_key_exists('id', $response)) {
            $message->id = $response['id'];
            return true;
        }

        return false;
    }

    /**
     * Search email-messages on the part of the name or label.
     *
     * @param string $search
     * @param int $offset
     * @param int $limit
     * @return Types\EmailMessage[]
     * @throws ESException
     */
    public function searchEmails($search = '', $offset = 0, $limit = 500)
    {
        $response = $this->request('GET', 'messages/email', array(
            'startindex' => $offset + 1,
            'maxrows'    => $limit,
            'search'     => $search
        ));

        return array_map(function ($message) {
            return new Types\EmailMessage($message);
        }, $response);
    }

    /**
     * Get email-message.
     *
     * @param int $id
     * @return Types\EmailMessage
     * @throws ESException
     */
    public function getEmail($id)
    {
        $response = $this->request('GET', 'messages/email/' . $id);

        if ($this->httpCode === 404) {
            return null;
        }

        return new Types\EmailMessage($response);
    }

    /**
     * Update email-message.
     *
     * @param Types\EmailMessage $message
     * @return boolean
     * @throws ESException
     */
    public function updateMessage(Types\EmailMessage $message)
    {
        $response = $this->request('PUT', 'messages/email/' . $message->id, array(), $message);

        if ($this->httpCode === 404) {
            return false;
        }

        return $response !== false;
    }

    /**
     * Remove email-message.
     *
     * @param int|Types\EmailMessage $message
     * @return boolean
     * @throws ESException
     */
    public function deleteEmail($message)
    {
        if ($message instanceof Types\EmailMessage) {
            $message = $message->id;
        }

        $response = $this->request('DELETE', 'messages/email/' . $message);

        if ($this->httpCode === 404) {
            return false;
        }

        return $response !== false;
    }

    public function getInstantMessagesStatus()
    {
        // message/status GET
    }

    public function sendSMS()
    {
        // /v1/message/sms	POST
    }

    public function getInstantSmsStatus()
    {
        // /v1/message/sms/status	GET
    }

    public function searchSms()
    {
        // /v1/messages/sms	GET
    }

    public function getImportSessionStatus()
    {
        // /v1/importstatus/{sessionId}	GET
    }

    public function getSmsInterfaces()
    {
        // /v1/interfaces/sms	GET
    }

    public function sendPreparedMessage()
    {
        // /v1/message/{id}/send	POST
    }

    public function sendExtendedPreparedMessage()
    {
        // /v1/message/{id}/smartsend	POST
    }

    public function ordersBulkInsert(array $orders)
    {
        // orders POST
    }

    public function getSmsCallouts()
    {
        // callouts/sms GET
    }

    public function contactActivity()
    {
        // contactActivity GET
    }

    public function startCampaign()
    {
        // campaigns/{id}/star POST
    }

    public function searchContactsOld()
    {
        // contacts/old GET
    }

    /**
     * @param int $id
     */
    public function stopImCallout($id)
    {
        // messages/{id}/stop POST
    }

    /**
     * Get last response http code
     *
     * @return int
     */
    public function getResponseHTTPCode()
    {
        return $this->httpCode;
    }

    /**
     * Get last response body
     *
     * @return string
     */
    public function getResponseBody()
    {
        return $this->httpResponse;
    }

    /**
     * Make request to ESputnik API
     *
     * @param $method
     * @param $action
     * @param array $query
     * @param mixed $data
     * @param array $headers
     * @return mixed
     * @throws ESException
     */
    protected function request($method, $action, array $query = array(), $data = null, &$headers = null)
    {
        curl_setopt($this->curl, CURLOPT_URL, 'https://esputnik.com.ua/api/v1/' . $action . '?' . http_build_query($query));
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        if (in_array($method, array('PUT', 'POST'))) {
            $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $json);
        }

        $response = curl_exec($this->curl);

        $this->httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
        preg_match_all('/^(?<header>[^:]+):(?<value>.*)$/m', substr($response, 0, $header_size), $matches, PREG_SET_ORDER);
        $headers = array_reduce($matches, function ($result, $match) {
            $result[$match['header']] = trim($match['value']);
            return $result;
        }, array());

        $this->httpResponse = mb_strlen($response) === $header_size ? '' : substr($response, $header_size);

        switch ($this->httpCode) {
            case 401:
                throw new ESException('Unauthorized', 401);
            case 400:
                throw new ESException('Request error: ' . $this->httpResponse, 400);
        }


        if ($this->httpResponse === false || curl_getinfo($this->curl, CURLINFO_HTTP_CODE) !== 200) {
            throw new ESException('Connection error: ' . $this->httpResponse, $this->httpCode);
        }

        return json_decode($this->httpResponse, true);
    }
}