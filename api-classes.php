<?php

class Product {

    // Public Properties
    public $ProductName;
    public $ProductLine;
    public $ProductType;
    public $Deductible;
    public $TripLength;
    public $SumInsured;
    public $DepartDate;
    public $ReturnDate;


    // Constructor
    function Product()
    {
        $this->TripLength = 0;
        $this->SumInsured = 0;
    }
};


class Address {

    public $Province;

    function Address()
    {

    }
};

// Class definition for a quote applicant's details
class Applicant {

    public $ID;
    public $CIMSContractID;
    public $BirthDate;
    public $Age;
    public $Address;
    public $SendEmailConfirmation;
    public $Relationship;
    public $Products;
    public $IsSmoker;
    public $ContactByEmail;

    function Applicant()
    {

    }
};

// Class definition for a quote application object
class Application {

    public $Applicants;
    public $SimulateDeclinedApp;
    public $SimulateTransaction;
    public $MaxTriesReached;
    public $ApplicationDate;
    public $MediaChannelType;
    public $ResponseReceivedServicesForPolicyExtend;
    public $ResponseSeekForReceivedServicesPolicyExtend;
    public $AdminFee;

    function Application()
    {
        $this->SimulateDeclinedApp = false;
        $this->SimulateTransaction = false;
        $this->MaxTriesReached = false;
        $this->ApplicationDate = date("Y-m-d");
        $this->MediaChannelType = "Unanswered";
        $this->ResponseReceivedServicesForPolicyExtend = "UnAnswered";
        $this->ResponseSeekForReceivedServicesPolicyExtend = "UnAnswered";
        $this->AdminFee = 0.0;
    }
};