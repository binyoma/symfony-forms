<?php

namespace App\Form\Model;

use App\Validator\UniqueUser;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegistrationFormModel
{
    /**
     * @Assert\NotBlank(message="Please enter an email address")
     * @Assert\Email()
     * @UniqueUser()
     */
    public $email;
    /**
     * @Assert\NotBlank(message="Please enter a password")
     * @Assert\Length(min=5, minMessage="Your password must be at least 5 characters long")
     */
    public $plainPassword;
    /**
     * @Assert\IsTrue(message="You must agree to the terms and conditions")
     */
    public $agreeTerms;

}