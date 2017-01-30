<?php

function getPostalAbbreviations ($territory) {
    switch ($territory) {
        case "Ontario":
            return "ON";
            break;
        case "Alberta":
            return "AB";
            break;
        case "British Columbia":
            return "BC";
            break;
        case "Manitoba":
            return "MB";
            break;
        case "New Brunswick":
            return "NB";
            break;
        case "Newfoundland &amp; Labrador":
            return "NL";
            break;
        case "Northwest Territories":
            return "NT";
            break;
        case "Nova Scotia":
            return "NS";
            break;
        case "Nunavut":
            return "NU";
            break;
        case "Prince Edward Island":
            return "PE";
            break;
        case "Quebec":
            return "PQ";
            break;
        case "Saskatchewan":
            return "SK";
            break;
        case "Yukon":
            return "YT";
            break;
    }
}