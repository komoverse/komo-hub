@extends('user.before-login-template')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col"></div>
        <div class="col-12 col-md-5 my-5 bg-dark text-light p-5">
            <div class="text-center">
                <img src="{{ url('assets/img/logo.png') }}" alt="">
            </div>
            @if (session('error'))
            <div class="alert alert-danger">
            {{ session('error') }}
            </div>
            @endif
            <h2>Register</h2>
            <form action="{{ url('register') }}" method="POST">
                @csrf
                Username <span class="red">*</span>
                <input type="text" name="komo_username" required="required" class="form-control my-1">
                <i id="username-exists" class="form-validation red" style="display: none">Username already exist<br></i>
                <i id="username-available" class="form-validation green" style="display: none">Username available<br></i>

                Email <span class="red">*</span>
                <input type="email" name="email" required="required" class="form-control my-1">
                <i id="email-exists" class="form-validation red" style="display: none">Email already used<br></i>
                <i id="email-available" class="form-validation green" style="display: none">Email available<br></i>

                Password <span class="red">*</span>
                <input type="password" name="password" required="required" class="form-control my-1">

                Confirm Password <span class="red">*</span>
                <input type="password" name="confirm_password" required="required" class="form-control my-1">
                <i id="pass-mismatch" class="form-validation red" style="display: none">Password not match<br></i>

                Country <span class="red">*</span>
                <!-- All countries -->
                <select id="country" class="form-select my-1" required="required" name="country">
                    <option disabled="disabled" selected="selected">Select country...</option>
                    <option value="AFG">Afghanistan</option>
                    <option value="ALA">Aland Islands</option>
                    <option value="ALB">Albania</option>
                    <option value="DZA">Algeria</option>
                    <option value="ASM">American Samoa</option>
                    <option value="AND">Andorra</option>
                    <option value="AGO">Angola</option>
                    <option value="AIA">Anguilla</option>
                    <option value="ATA">Antarctica</option>
                    <option value="ATG">Antigua and Barbuda</option>
                    <option value="ARG">Argentina</option>
                    <option value="ARM">Armenia</option>
                    <option value="ABW">Aruba</option>
                    <option value="AUS">Australia</option>
                    <option value="AUT">Austria</option>
                    <option value="AZE">Azerbaijan</option>
                    <option value="BHS">Bahamas</option>
                    <option value="BHR">Bahrain</option>
                    <option value="BGD">Bangladesh</option>
                    <option value="BRB">Barbados</option>
                    <option value="BLR">Belarus</option>
                    <option value="BEL">Belgium</option>
                    <option value="BLZ">Belize</option>
                    <option value="BEN">Benin</option>
                    <option value="BMU">Bermuda</option>
                    <option value="BTN">Bhutan</option>
                    <option value="BOL">Bolivia</option>
                    <option value="BES">Bonaire, Sint Eustatius and Saba</option>
                    <option value="BIH">Bosnia and Herzegovina</option>
                    <option value="BWA">Botswana</option>
                    <option value="BVT">Bouvet Island</option>
                    <option value="BRA">Brazil</option>
                    <option value="IOT">British Indian Ocean Territory</option>
                    <option value="BRN">Brunei Darussalam</option>
                    <option value="BGR">Bulgaria</option>
                    <option value="BFA">Burkina Faso</option>
                    <option value="BDI">Burundi</option>
                    <option value="KHM">Cambodia</option>
                    <option value="CMR">Cameroon</option>
                    <option value="CAN">Canada</option>
                    <option value="CPV">Cape Verde</option>
                    <option value="CYM">Cayman Islands</option>
                    <option value="CAF">Central African Republic</option>
                    <option value="TCD">Chad</option>
                    <option value="CHL">Chile</option>
                    <option value="CHN">China</option>
                    <option value="CXR">Christmas Island</option>
                    <option value="CCK">Cocos (Keeling) Islands</option>
                    <option value="COL">Colombia</option>
                    <option value="COM">Comoros</option>
                    <option value="COG">Congo</option>
                    <option value="COD">Congo, Democratic Republic of the Congo</option>
                    <option value="COK">Cook Islands</option>
                    <option value="CRI">Costa Rica</option>
                    <option value="CIV">Cote D'Ivoire</option>
                    <option value="HRV">Croatia</option>
                    <option value="CUB">Cuba</option>
                    <option value="CUW">Curacao</option>
                    <option value="CYP">Cyprus</option>
                    <option value="CZE">Czech Republic</option>
                    <option value="DNK">Denmark</option>
                    <option value="DJI">Djibouti</option>
                    <option value="DMA">Dominica</option>
                    <option value="DOM">Dominican Republic</option>
                    <option value="ECU">Ecuador</option>
                    <option value="EGY">Egypt</option>
                    <option value="SLV">El Salvador</option>
                    <option value="GNQ">Equatorial Guinea</option>
                    <option value="ERI">Eritrea</option>
                    <option value="EST">Estonia</option>
                    <option value="ETH">Ethiopia</option>
                    <option value="FLK">Falkland Islands (Malvinas)</option>
                    <option value="FRO">Faroe Islands</option>
                    <option value="FJI">Fiji</option>
                    <option value="FIN">Finland</option>
                    <option value="FRA">France</option>
                    <option value="GUF">French Guiana</option>
                    <option value="PYF">French Polynesia</option>
                    <option value="ATF">French Southern Territories</option>
                    <option value="GAB">Gabon</option>
                    <option value="GMB">Gambia</option>
                    <option value="GEO">Georgia</option>
                    <option value="DEU">Germany</option>
                    <option value="GHA">Ghana</option>
                    <option value="GIB">Gibraltar</option>
                    <option value="GRC">Greece</option>
                    <option value="GRL">Greenland</option>
                    <option value="GRD">Grenada</option>
                    <option value="GLP">Guadeloupe</option>
                    <option value="GUM">Guam</option>
                    <option value="GTM">Guatemala</option>
                    <option value="GGY">Guernsey</option>
                    <option value="GIN">Guinea</option>
                    <option value="GNB">Guinea-Bissau</option>
                    <option value="GUY">Guyana</option>
                    <option value="HTI">Haiti</option>
                    <option value="HMD">Heard Island and Mcdonald Islands</option>
                    <option value="VAT">Holy See (Vatican City State)</option>
                    <option value="HND">Honduras</option>
                    <option value="HKG">Hong Kong</option>
                    <option value="HUN">Hungary</option>
                    <option value="ISL">Iceland</option>
                    <option value="IND">India</option>
                    <option value="IDN">Indonesia</option>
                    <option value="IRN">Iran, Islamic Republic of</option>
                    <option value="IRQ">Iraq</option>
                    <option value="IRL">Ireland</option>
                    <option value="IMN">Isle of Man</option>
                    <option value="ISR">Israel</option>
                    <option value="ITA">Italy</option>
                    <option value="JAM">Jamaica</option>
                    <option value="JPN">Japan</option>
                    <option value="JEY">Jersey</option>
                    <option value="JOR">Jordan</option>
                    <option value="KAZ">Kazakhstan</option>
                    <option value="KEN">Kenya</option>
                    <option value="KIR">Kiribati</option>
                    <option value="PRK">Korea, Democratic People's Republic of</option>
                    <option value="KOR">Korea, Republic of</option>
                    <option value="XKX">Kosovo</option>
                    <option value="KWT">Kuwait</option>
                    <option value="KGZ">Kyrgyzstan</option>
                    <option value="LAO">Lao People's Democratic Republic</option>
                    <option value="LVA">Latvia</option>
                    <option value="LBN">Lebanon</option>
                    <option value="LSO">Lesotho</option>
                    <option value="LBR">Liberia</option>
                    <option value="LBY">Libyan Arab Jamahiriya</option>
                    <option value="LIE">Liechtenstein</option>
                    <option value="LTU">Lithuania</option>
                    <option value="LUX">Luxembourg</option>
                    <option value="MAC">Macao</option>
                    <option value="MKD">Macedonia, the Former Yugoslav Republic of</option>
                    <option value="MDG">Madagascar</option>
                    <option value="MWI">Malawi</option>
                    <option value="MYS">Malaysia</option>
                    <option value="MDV">Maldives</option>
                    <option value="MLI">Mali</option>
                    <option value="MLT">Malta</option>
                    <option value="MHL">Marshall Islands</option>
                    <option value="MTQ">Martinique</option>
                    <option value="MRT">Mauritania</option>
                    <option value="MUS">Mauritius</option>
                    <option value="MYT">Mayotte</option>
                    <option value="MEX">Mexico</option>
                    <option value="FSM">Micronesia, Federated States of</option>
                    <option value="MDA">Moldova, Republic of</option>
                    <option value="MCO">Monaco</option>
                    <option value="MNG">Mongolia</option>
                    <option value="MNE">Montenegro</option>
                    <option value="MSR">Montserrat</option>
                    <option value="MAR">Morocco</option>
                    <option value="MOZ">Mozambique</option>
                    <option value="MMR">Myanmar</option>
                    <option value="NAM">Namibia</option>
                    <option value="NRU">Nauru</option>
                    <option value="NPL">Nepal</option>
                    <option value="NLD">Netherlands</option>
                    <option value="ANT">Netherlands Antilles</option>
                    <option value="NCL">New Caledonia</option>
                    <option value="NZL">New Zealand</option>
                    <option value="NIC">Nicaragua</option>
                    <option value="NER">Niger</option>
                    <option value="NGA">Nigeria</option>
                    <option value="NIU">Niue</option>
                    <option value="NFK">Norfolk Island</option>
                    <option value="MNP">Northern Mariana Islands</option>
                    <option value="NOR">Norway</option>
                    <option value="OMN">Oman</option>
                    <option value="PAK">Pakistan</option>
                    <option value="PLW">Palau</option>
                    <option value="PSE">Palestinian Territory, Occupied</option>
                    <option value="PAN">Panama</option>
                    <option value="PNG">Papua New Guinea</option>
                    <option value="PRY">Paraguay</option>
                    <option value="PER">Peru</option>
                    <option value="PHL">Philippines</option>
                    <option value="PCN">Pitcairn</option>
                    <option value="POL">Poland</option>
                    <option value="PRT">Portugal</option>
                    <option value="PRI">Puerto Rico</option>
                    <option value="QAT">Qatar</option>
                    <option value="REU">Reunion</option>
                    <option value="ROM">Romania</option>
                    <option value="RUS">Russian Federation</option>
                    <option value="RWA">Rwanda</option>
                    <option value="BLM">Saint Barthelemy</option>
                    <option value="SHN">Saint Helena</option>
                    <option value="KNA">Saint Kitts and Nevis</option>
                    <option value="LCA">Saint Lucia</option>
                    <option value="MAF">Saint Martin</option>
                    <option value="SPM">Saint Pierre and Miquelon</option>
                    <option value="VCT">Saint Vincent and the Grenadines</option>
                    <option value="WSM">Samoa</option>
                    <option value="SMR">San Marino</option>
                    <option value="STP">Sao Tome and Principe</option>
                    <option value="SAU">Saudi Arabia</option>
                    <option value="SEN">Senegal</option>
                    <option value="SRB">Serbia</option>
                    <option value="SCG">Serbia and Montenegro</option>
                    <option value="SYC">Seychelles</option>
                    <option value="SLE">Sierra Leone</option>
                    <option value="SGP">Singapore</option>
                    <option value="SXM">Sint Maarten</option>
                    <option value="SVK">Slovakia</option>
                    <option value="SVN">Slovenia</option>
                    <option value="SLB">Solomon Islands</option>
                    <option value="SOM">Somalia</option>
                    <option value="ZAF">South Africa</option>
                    <option value="SGS">South Georgia and the South Sandwich Islands</option>
                    <option value="SSD">South Sudan</option>
                    <option value="ESP">Spain</option>
                    <option value="LKA">Sri Lanka</option>
                    <option value="SDN">Sudan</option>
                    <option value="SUR">Suriname</option>
                    <option value="SJM">Svalbard and Jan Mayen</option>
                    <option value="SWZ">Swaziland</option>
                    <option value="SWE">Sweden</option>
                    <option value="CHE">Switzerland</option>
                    <option value="SYR">Syrian Arab Republic</option>
                    <option value="TWN">Taiwan, Province of China</option>
                    <option value="TJK">Tajikistan</option>
                    <option value="TZA">Tanzania, United Republic of</option>
                    <option value="THA">Thailand</option>
                    <option value="TLS">Timor-Leste</option>
                    <option value="TGO">Togo</option>
                    <option value="TKL">Tokelau</option>
                    <option value="TON">Tonga</option>
                    <option value="TTO">Trinidad and Tobago</option>
                    <option value="TUN">Tunisia</option>
                    <option value="TUR">Turkey</option>
                    <option value="TKM">Turkmenistan</option>
                    <option value="TCA">Turks and Caicos Islands</option>
                    <option value="TUV">Tuvalu</option>
                    <option value="UGA">Uganda</option>
                    <option value="UKR">Ukraine</option>
                    <option value="ARE">United Arab Emirates</option>
                    <option value="GBR">United Kingdom</option>
                    <option value="USA">United States</option>
                    <option value="UMI">United States Minor Outlying Islands</option>
                    <option value="URY">Uruguay</option>
                    <option value="UZB">Uzbekistan</option>
                    <option value="VUT">Vanuatu</option>
                    <option value="VEN">Venezuela</option>
                    <option value="VNM">Viet Nam</option>
                    <option value="VGB">Virgin Islands, British</option>
                    <option value="VIR">Virgin Islands, U.s.</option>
                    <option value="WLF">Wallis and Futuna</option>
                    <option value="ESH">Western Sahara</option>
                    <option value="YEM">Yemen</option>
                    <option value="ZMB">Zambia</option>
                    <option value="ZWE">Zimbabwe</option>
                </select>

                Solana Wallet Address <i class="fs-6">(optional)</i>
                <input type="text" name="wallet_pubkey" class="form-control my-1">
                <i id="wallet-exists" class="form-validation red" style="display: none">Wallet already used<br></i>
                <i id="wallet-available" class="form-validation green" style="display: none">Wallet available<br></i>

                <div class="g-recaptcha mt-2" data-sitekey="{{ $g_recaptcha_site_key }}"></div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="terms">
                    <label class="form-check-label" for="terms">
                        I agree to <a href="https://komoverse.io/privacy-policy" target="_blank">Privacy Policy</a> and <a href="https://komoverse.io/terms-of-use" target="_blank">Terms of Use</a>
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="subscribe">
                    <label class="form-check-label" for="subscribe">
                        Subscribe to Game Patch and Announcement Mailing List
                    </label>
                </div>
                <button id="submitButton" class="btn form-control btn-success mt-2"><i class="fas fa-save"></i> &nbsp; Register</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
@section('script')
<script>
    const valid = [false, false, true, false];
    // var valid[0] = false;
    // var valid[1] = false;
    // var valid[2] = true;
    // var valid[3] = false;
    $('input[name=komo_username]').on('change paste keyup focusout', function(){
        var username = $(this).val();
        var csrf = $('input[name=_token]').val();
        if (username != '') {
            $.ajax({
                url: "{{ url('validate/check-username') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    komo_username: username,
                    _token: csrf,
                },
            })
            .always(function(result) {
                console.log(result);
                if (result.message == 'Username Exists') {
                    $("#username-available").hide();
                    $("#username-exists").show();
                    valid[0] = false;
                } else {
                    $("#username-available").show();
                    $("#username-exists").hide();
                    valid[0] = true;
                }
            });
        } else {
            $("#username-available").hide();
            $("#username-exists").hide();
            valid[0] = false;
        }
    });

    $('input[name=email]').on('change paste keyup focusout', function(){
        var email = $(this).val();
        var csrf = $('input[name=_token]').val();
        console.log(email);
        if (email != ''){
            $.ajax({
                url: "{{ url('validate/check-email') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    email: email,
                    _token: csrf,
                },
            })
            .always(function(result) {
                console.log(result);
                if (result.message == 'Email Exists') {
                    $("#email-available").hide();
                    $("#email-exists").show();
                    valid[1] = false;
                } else {
                    $("#email-available").show();
                    $("#email-exists").hide();
                    valid[1] = true;
                }
            });
        } else {
            $("#email-available").hide();
            $("#email-exists").hide();
            valid[0] = false;
        }
    });

    $('input[name=wallet_pubkey]').on('change paste keyup focusout', function(){
        var wallet_pubkey = $(this).val();
        var csrf = $('input[name=_token]').val();
        console.log(wallet_pubkey);
        if (wallet_pubkey != '') {
            $.ajax({
                url: "{{ url('validate/check-wallet') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    wallet_pubkey: wallet_pubkey,
                    _token: csrf,
                },
            })
            .always(function(result) {
                console.log(result);
                if (result.message == 'Wallet Exists') {
                    $("#wallet-available").hide();
                    $("#wallet-exists").show();
                    valid[2] = false;
                } else {
                    $("#wallet-available").show();
                    $("#wallet-exists").hide();
                    valid[2] = true;
                }
            });
        } else {
            $("#wallet-available").hide();
            $("#wallet-exists").hide();
            valid[2] = true;
        }
    });

    function revalidatePassword() {
        var pass1 = $('input[name=password]').val();
        var pass2 = $('input[name=confirm_password]').val();
        if (pass1 != '') {
            if (pass1 === pass2) {
                $("#pass-mismatch").hide();
                valid[3] = true;
            } else {
                $("#pass-mismatch").show();
                valid[3] = false;
            }
        } else {
            $("#pass-mismatch").hide();
            valid[3] = false;
        }
    }

    $('input[type=password]').on('change paste keyup focusout', function(){
        revalidatePassword();
    });

    $('#submitButton').on('click', function(e){
        e.preventDefault();
        var allvalid = true;
        $.each(valid, function(index, val) {
             if (val == false) {
                allvalid = false;
             }
             console.log(index+' '+val);
        });
        if (allvalid == true) {
            $('form').submit();
        } else {
            alert('Some input are not valid');
        }
    });
</script>
@endsection