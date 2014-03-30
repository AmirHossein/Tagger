<?php
/**
 * Create a Group
 * 
 * @package tagger
 * @subpackage processors
 */
class TaggerGroupCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'TaggerGroup';
    public $languageTopics = array('tagger:default');
    public $objectType = 'tagger.group';

    public function beforeSet() {
        $fieldType = $this->getProperty('field_type');

        if ($fieldType != 'tagger-field-tags') {
            $this->setProperty('show_autotag', 0);
        }

        return parent::beforeSet();
    }

    public function beforeSave() {
        $name = $this->getProperty('name');

        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('tagger.err.group_name_ns'));
        } else if ($this->doesAlreadyExist(array('name' => $name))) {
            $this->addFieldError('name',$this->modx->lexicon('tagger.err.group_name_ae'));
        }
        return parent::beforeSave();
    }
}
return 'TaggerGroupCreateProcessor';
