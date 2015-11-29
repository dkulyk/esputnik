<?php
/**
 * This file is part of ESputnik API connector
 *
 * @package ESputnik
 * @license MIT
 * @author Dmytro Kulyk <lnkvisitor.ts@gmail.com>
 */

namespace ESputnik\Types;

use ESputnik\Object;

/**
 * Class ContactsBulkUpdate
 *
 * @property Contact[] $contacts
 * @property mixed $dedupeOn
 * @property int $fieldId
 * @property ContactField[] $contactFields
 * @property int[] $customFieldsIDs
 * @property string[] $groupNames
 * @property boolean $restoreDeleted
 */
class ContactsBulkUpdate extends Object
{
    /**
     * @var Contact[]
     */
    protected $contacts = array();

    /**
     * @var mixed
     */
    protected $dedupeOn = 'email';

    /**
     * @var int
     */
    protected $fieldId;

    /**
     * @var ContactField[]
     */
    protected $contactFields = array();

    /**
     * @var int[]
     */
    protected $customFieldsIDs = array();

    /**
     * @var string[]
     */
    protected $groupNames = array();

    /**
     * @var boolean
     */
    protected $restoreDeleted = false;

    /**
     * @param Contact[] $contacts
     */
    public function setContacts(array $contacts)
    {
        $this->contacts = array_map(function ($contact) {
            return $contact instanceof Contact ? $contact : new Contact($contact);
        }, $contacts);
    }

    /**
     * @param ContactField[] $contactFields
     */
    public function setContactFields(array $contactFields)
    {
        $this->contactFields = array_map(function ($contactField) {
            return $contactField instanceof ContactField ? $contactField : new ContactField($contactField);
        }, $contactFields);
    }

    /**
     * @param int[] $customFieldsIDs
     */
    public function setCustomFieldsIDs(array $customFieldsIDs)
    {
        $this->contactFields = array_map('intval', $customFieldsIDs);
    }

    /**
     * @param string[] $groupNames
     */
    public function setGroupNames(array $groupNames)
    {
        $this->groupNames = array_map('strval', $groupNames);
    }
}