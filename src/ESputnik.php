<?php
/**
 * This file is part of ESputnik API connector
 *
 * @package ESputnik
 * @license MIT
 * @author Dmytro Kulyk <lnkvisitor.ts@gmail.com>
 */

namespace ESputnik;

/**
 * Class ESputnik
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
     * @var resource
     */
    protected $curl;

    /**
     * ESputnik constructor.
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
    public function version()
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
    public function getBalance()
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
    public function getContacts($offset = 0, $limit = 500, array $params = array())
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
    public function updateContacts(Types\ContactsBulkUpdate $contacts)
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
    public function getContactsEmails(array $ids)
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
        return $this->request('PUT', 'contact/' . $contact->id, array(), $contact) !== false;
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
        return $this->request('DELETE', 'contact/' . $contact) !== false;
    }

    /**
     * Add email-in to the list unsubscribe.
     *
     * @param string[] $emails
     * @return bool
     * @throws ESException
     * @todo untested
     */
    public function addUnsubscribed(array $emails)
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
    public function deleteUnsubscribed(array $emails)
    {
        return $this->request('POST', 'emails/unsubscribed/delete', array(), array('emails' => $emails)) !== false;
    }

    /**
     * Add New Event.
     *
     * @param Types\Event $event
     * @return boolean
     * @throws ESException
     * @todo untested
     */
    public function addEvent(Types\Event $event)
    {
        return $this->request('POST', 'event', array(), $event) !== false;
    }

    /**
     * Search groups.
     *
     * @param int $offset
     * @param int $limit
     * @param string[] $params
     * @return Types\Group[]
     * @throws ESException
     */
    public function getGroups($offset = 0, $limit = 500, array $params = array())
    {
        $response = $this->request('GET', 'groups', array_merge($params, array(
            'startindex' => $offset + 1,
            'maxrows'    => $limit
        )));

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
        ),null,$headers);

        return new Types\Contacts(array(
            'totalCount' => $headers['TotalCount'],
            'contacts'   => $response
        ));
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

        $header_size = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
        preg_match_all('/^(?<header>[^:]+):(?<value>.*)$/m', substr($response, 0, $header_size), $matches, PREG_SET_ORDER);
        $headers = array_reduce($matches, function ($result, $match) {
            $result[$match['header']] = trim($match['value']);
            return $result;
        }, array());

        $content = substr($response, $header_size);

        if ($content === false || curl_getinfo($this->curl, CURLINFO_HTTP_CODE) !== 200) {
            throw new ESException('Connection error: ' . $content, curl_getinfo($this->curl, CURLINFO_HTTP_CODE));
        }

        return json_decode($content, true);
    }
}