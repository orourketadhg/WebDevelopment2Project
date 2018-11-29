<?php

    include 'Searching.php';
    include 'SessionCheck.php';

    // Function for main checks and actions
    function onLoad() {
        SessionCheck();

    }


    // Function to generate dropdown menu for categories
    function DropDown() {

        $Categories = DropDownCategories();

        // handling default load value
        if (!$_POST) {
            $_POST['SearchCategory'] = '';
        }

        // create drop down
        echo '<label for="CategoryBox">Category:</label>';
        echo '<select name="SearchCategory" id="CategoryBox">';

        echo '<option name="Default">-- Choose a Category --</option>';

        // give category options
        for($i = 0; $i < count($Categories); $i++) {
            echo "<option name=$Categories[$i]>$Categories[$i]</option>";

        }

        echo ' </select>';
    }


    // function to decide on page numbering
    function getPage() {
        return;
    }


    //function to either increment of decrement the page number
    function updatePageNumber($option) {


    }


