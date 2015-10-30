<head><style type="text/css">

.clickable label {
    cursor: pointer;
    //border-bottom: 1px solid #000;
    font-family: Arial, sans-serif;
}

.clickable .appear { 
    display: none;
    font-family: Arial, sans-serif;
    background: black;
    color: #fff;
    padding: 10px;
}

.clickable input {
    display: none;
}
.clickable input:checked ~ .appear {
    display: block;
}
a {text-decoration: none; }
</style>
</head>


<div class="clickable">
<label for="the-checkbox" style="text-decoration:none;">Click Me!</label><br>
<input type="checkbox" id="the-checkbox"> <p></p>
<div class="appear">Some text to appear</div>
</div>