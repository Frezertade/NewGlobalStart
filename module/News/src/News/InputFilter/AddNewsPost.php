<?php

namespace News\InputFilter;

use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
//use Zend\I18n\Validator\Alnum;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\Regex;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

class AddNewsPost extends InputFilter
{
    public function __construct()
    {
        $title = new Input('title');
        $title->setRequired(true);
        $title->setValidatorChain($this->getTitleValidatorChain());
        $title->setFilterChain($this->getStringTrimFilterChain());

        $description = new Input('description');
        $description->setRequired(true);
//        $description->setValidatorChain($this->getSlugValidatorChain());
        $description->setFilterChain($this->getStringTrimFilterChain());

        $content = new Input('content');
        $content->setRequired(true);
        $content->setValidatorChain($this->getContentValidatorChain());
        $content->setFilterChain($this->getStringTrimFilterChain());

        $published_date = new Input('published_date');
        $published_date->setRequired(true);
        $content->setValidatorChain($this->getContentValidatorChain());
        $content->setFilterChain($this->getStringTrimFilterChain());

        $this->add($title);
        $this->add($description);
        $this->add($published_date);
        $this->add($content);
    }

    /**
     * @return ValidatorChain
     */
    protected function getContentValidatorChain()
    {
        $stringLength = new StringLength();
        $stringLength->setMin(10);
        $validatorChain = new ValidatorChain();
        $validatorChain->attach($stringLength);

        return $validatorChain;
    }

    /**
     * @return ValidatorChain
     */
    protected function getSlugValidatorChain()
    {
        $stringLength = new StringLength();
        $stringLength->setMin(2);

        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Regex("/^[a-z0-9\\-]+$/"));
        $validatorChain->attach($stringLength);

        return $validatorChain;
    }

    /**
     * @return ValidatorChain
     */
    protected function getTitleValidatorChain()
    {
        $stringLength = new StringLength();
        $stringLength->setMin(5);

        $validatorChain = new ValidatorChain();
//        $validatorChain->attach(new Alnum(true));
        $validatorChain->attach($stringLength);

        return $validatorChain;
    }

    /**
     * @return FilterChain
     */
    protected function getStringTrimFilterChain()
    {
        $filterChain = new FilterChain();
        $filterChain->attach(new StringTrim());

        return $filterChain;
    }
} 