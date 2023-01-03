<?php
    if (isset($_POST['card-number']) && isset($_POST['card-holder']) && isset($_POST['expiration-date']) && isset($_POST['cvv'])) {
        $cardNumber = $_POST['card-number'];
        $cardHolder = $_POST['card-holder'];
        $expirationDate = $_POST['expiration-date'];
        $cvv = $_POST['cvv'];
    }
    else {
        $cardNumber = "";
        $cardHolder = "";
        $expirationDate = "";
        $cvv = "";
    }

    function verif_cardNumber($cardNumber) {
        if (strlen($cardNumber) == 19) {
            $cardNumber = str_replace(' ', '', $cardNumber);
            if (is_numeric($cardNumber)) {
                if($cardNumber[0] == $cardNumber[strlen($cardNumber) - 1]) {
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        } else {
            return false;
        }
    }

    function verif_expDate($expirationDate) {
        $date = explode("/", $expirationDate);
        $month = $date[0];
        $year = $date[1];

        /*Date of today*/
        $today = getdate();

        /*Verify that the date is more than Today date + 3 months*/
        if ($year == substr($today['year'],2)) {
            if ($month >= $today['mon'] + 3) {
                return true;
            } else {
                return false;
            }
        }
        else if ($year == substr($today['year'],2) + 1) {
            $month = $month + 12;
            if ($month >= $today['mon'] + 3) {
                return true;
            } else {
                return false;
            }
        }
        else if ($year < substr($today['year'],2)) {
            return false;
        }
        else {
            return true;
        }
    }

    if ($cardNumber == "" && $expirationDate == "" && $cvv == "" && $cardHolder == "") {
        header('Location: checkout.php');
    }
    else if (verif_cardNumber($cardNumber) && verif_expDate($expirationDate)) {
        header('Location: confirmation.html');
    }
    else {
        if (!verif_cardNumber($cardNumber)) {
            header('Location: errorCardNumber.php');
        }
        else if (!verif_expDate($expirationDate)) {
            header('Location: errorExpDate.php');
        }
    }