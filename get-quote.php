<?php

// API Classes
include_once "api-classes.php";
include_once "api-helpers.php";

// Debugging error display code
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

$apiUrl = "https://test.gms.ca/test04/cims/services/1.2/travel.asmx?wsdl";
$securityKey = "DF9CEE30-40B5-410F-BB60-CAF10B125D35";

// Get posted variables
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

// Create a new product
$products = array();
$curProduct = new Product();
$departDate = DateTime::createFromFormat('d/m/Y', $_POST['departureDate']);
$returnDate = DateTime::createFromFormat('d/m/Y', $_POST['returnDate']);

$curProduct->ProductName = "EmergencyMedical";
$curProduct->ProductLine = "TravelStar";
$curProduct->ProductType = "SingleTrip";
$curProduct->Deductible = 0;
$curProduct->TripLength = $_POST['numberOfDays'];
$curProduct->SumInsured = 0;
$curProduct->DepartDate = $departDate->format('Y-m-d');
$curProduct->ReturnDate = $returnDate->format('Y-m-d');

$products[] = $curProduct;


// Create a new address
$address = new Address();
$address->Province = getPostalAbbreviations($_POST['province']);

// Create a new applicant
$applicants = array();
$applicant = new Applicant();

$birthDate = DateTime::createFromFormat('d/m/Y', $_POST['dob']);

$applicant->ID = 1;
$applicant->CIMSContractID = 1;
$applicant->BirthDate = $birthDate->format('Y-m-d');
$applicant->Age = $_POST['age'];
$applicant->Address = $address;
$applicant->SendEmailConfirmation = false;
$applicant->Relationship = "Policyholder";
$applicant->Products = $products;
$applicant->IsSmoker = "Unknown";
$applicant->ContactByEmail = false;
$applicants[] = $applicant;

// Create a new application request
$application = new Application();
$application->Applicants = $applicants;
$application->SimulateDeclinedApp = false;
$application->SimulateTransaction = false;
$application->MaxTriesReached = false;
$application->ApplicationDate = date("c");
$application->MediaChannelType = "Unanswered";
$application->ResponseReceivedServicesForPolicyExtend = "UnAnswered";
$application->ResponseSeekForReceivedServicesPolicyExtend = "UnAnswered";
$application->AdminFee = 0.0;

$order = array();

$order[] = $application;


// Create a Soap Client instance
$client = new SoapClient($apiUrl, array('trace' => TRUE));

// Create the quote parameters for passing to the API
$quoteParams = array(
    "Application" => $application,
    "SecurityKey" => $securityKey
);

// Call GetQuote on the Travel API
$quote = $client->GetQuote($quoteParams);

// Get the price from the returned API results
$result = $quote->GetQuoteResult->Quotes->Quote->Products->PQProduct->Price;

// Format the returned price
$formattedResult = sprintf('$%01.2f', $result);

$client->__getLastRequest();

// Output the formatted result
echo($formattedResult);
