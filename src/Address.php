<?php
/**
 * Class to create address details
 */

namespace dwmsw\sagepay;

use InvalidArgumentException;

class Address
{

    /**
     * @var
     */
    protected $firstnames;

    /**
     * @var
     */
    protected $surname;

    /**
     * @var
     */
    protected $address1;

    /**
     * @var
     */
    protected $address2;

    /**
     * @var
     */
    protected $city;

    /**
     * @var
     */
    protected $country;

    /**
     * @var
     */
    protected $postcode;

    /**
     * @var
     */
    protected $state;

    /**
     * @var
     */
    protected $phone;

    /**
     * Getter for protected vars
     *
     * @param $var
     * @return bool
     */
    public function __get($var)
    {

        return isset($this->$var) ? $this->$var : false;
    }

    /**
     * Setter for names
     *
     * @param $firstnames
     * @param $surname
     */
    public function setName($firstnames, $surname)
    {
        if (strlen($firstnames) > 20) {
            throw new InvalidArgumentException('Firstnames must be less than 20 chars');
        } else {
            $this->firstnames = $firstnames;
        }

        if (strlen($surname) > 20) {
            throw new InvalidArgumentException('Surname must be less than 20 chars');
        } else {
            $this->surname = $surname;
        }
    }


    /**
     * Setter for phone
     *
     * @param bool $phone
     */
    public function setPhone($phone = false)
    {
        if ($phone != false && strlen($phone) > 20) {
            throw new InvalidArgumentException('Phone must be less than 20 chars');
        } else {
            $this->phone = $phone;
        }
    }


    /**
     * Setter for address
     *
     * @param string $address1
     * @param string $address2
     * @param string $city
     * @param string $country
     * @param string $postcode
     * @param bool   $state
     */
    public function setAddress($address1, $address2, $city, $country, $postcode, $state = false)
    {
        $countries = Utilities::getCountryCodes();

        if (strlen($address1) > 100) {
            throw new InvalidArgumentException('Address1 must be less than 100 chars');
        } else {
            $this->address1 = $address1;
        }

        if (strlen($address2) > 100) {
            throw new InvalidArgumentException('Address2 must be less than 100 chars');
        } else {
            $this->address2 = $address2;
        }

        if (strlen($city) > 100) {
            throw new InvalidArgumentException('City must be less than 40 chars');
        } else {
            $this->city = $city;
        }

        if (strlen($country) > 2) {
            throw new InvalidArgumentException('Country must be less than 2 chars');
        } elseif (!isset($countries[$country])) {
            throw new InvalidArgumentException('Country must be a valid ISO 3166 country code');
        } else {
            $this->country = $country;
        }

        if (strlen($postcode) > 10) {
            throw new InvalidArgumentException('Postcode must be less than 10 chars');
        } else {
            $this->postcode = $postcode;
        }

        if ($state === false && $country == 'US') {
            throw new InvalidArgumentException('State must be set for the US');
        } else {
            $this->state = $state;
        }
    }

}
