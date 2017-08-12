        $(document).ready(function(){

                $('.modal').modal({
                    dismissible: false
                });

//Start Initial Connection Insert
                getUserIP(function(ip){
                    var handling_param =$('#handling_param').val();

                    if(handling_param == " "){
                        checkConnection(ip);

                        setTimeout(
                            function() { 
                                postConnection(ip);
                            }, 3000);
                    }
                });

                var dateNow = new Date();

                var _dateTimeNow = dateNow.getFullYear() + "-" + (dateNow.getMonth() + 1) + "-" + dateNow.getDate() + " " + 
                    dateNow.getHours() + ":" + dateNow.getMinutes() + ":" + dateNow.getSeconds();

                var _dateNow = dateNow.getFullYear() + "-" + (dateNow.getMonth() + 1) + "-" + dateNow.getDate();

                function checkConnection(LocalIpAdd){
                    $.ajax({
                        url : "../public/checkConnection",
                        type: 'GET',
                        data: {
                            ipAddress       : LocalIpAdd,
                            connectionDate  : _dateNow
                        },
                        success: function (data) {
                            var countConnection = data[0]['countId'];

                            if(countConnection == 0){
                                $('#surveyModal').modal('open');
                            }
                            
                        }
                    });
                }

                function postConnection(LocalIpAdd){
                    $.ajax({
                        url : "../public/postConnection",
                        type: 'GET',
                        data: {
                            ipAddress       : LocalIpAdd,
                            connectionTime  : _dateTimeNow
                        }
                    });
                }
//End Initial Connection Insert
            });


            $('#proceed').click(function(){
                var in_name     = $("#in_name").val();
                var in_age      = $("#in_age").val();
                var in_ea_mn    = $("#in_ea_mn").val();

                var dateNow = new Date();
                var _dateTimeNow = dateNow.getFullYear() + "-" + (dateNow.getMonth() + 1) + "-" + dateNow.getDate() + " " + 
                    dateNow.getHours() + ":" + dateNow.getMinutes() + ":" + dateNow.getSeconds();

                var policy = document.getElementById("policy").checked;

                if(policy == false){

                    $('#policyModal').modal('open');

                    return false;
                }
                else{

                    $('#proceed').attr("disabled",true);

                    $.ajax({
                        url : "../public/insertSurvey",
                        type: 'GET',
                        data: {
                            name            : in_name,
                            age             : in_age,
                            email_mobile    : in_ea_mn,
                            answered_date   : _dateTimeNow
                        },
                        success: function (data) {

                            $('#proceed').removeAttr('disabled');

                            $('#surveyModal').modal('close');

                            $("#policyModal #close").css('display','none');

                            $('#promptModal').modal('open');

                            countdownTimer(5); 

                        }
                    }); 
                } 
            });

            $('#policyModal').scroll(function() {
              if ($(this).scrollTop() + $(this).height() >= $(this)[0].scrollHeight - 4) {
                $('#policyModal #close').css('display','inline-block');
              }
            });

            $('#surveyModal #policy').click(function(){

                $('#policy').removeAttr('checked');

            });

            $('#close').click(function(){
                document.getElementById("policy").checked = true;
                $('#surveyModal #policy').attr('checked',true);
            });

            $('#in_ea_mn').on('keyup', function(e){
                var input = $("#in_ea_mn").val();

                validateInput(input);
            });

            $('#surveyModal #policy').click(function(){
                $("#surveyModal div.error").remove();
            });

            function validateInput(input){

                $("#surveyModal div.error").remove();

                var intRegex = /[0-9 -()+]+$/;
                    if(input == "")
                    {
                        $('#proceed').attr("disabled",true);
                        $('#in_ea_mn').css("border-bottom","1px solid #ff1744");
                        $('#in_ea_mn').after('<div class="error">Please fill-up.</div>');
                        return false;
                    }
                    else if(intRegex.test(input)) {
                    //Validation Phone
                        if((input.length < 11) || (!intRegex.test(input)))
                            {
                                $('#proceed').attr("disabled",true);
                                $('#in_ea_mn').css("border-bottom","1px solid #ff1744");
                                $('#in_ea_mn').after('<div class="error">Please enter a valid mobile number.</div>');
                                return false;
                            }
                        else{
                            var phone_num = String(input);
                                if (!isNaN(phone_num)) {
                                    //if phone_num is a set of numbers and length is 11
                                    if (phone_num.substr(0, 2) == '09' && phone_num.length == 11) {
                                        var temp_phone_num = phone_num.replace(0, "63");
                                        $('#proceed').removeAttr('disabled');
                                        $('#in_ea_mn').css("border-bottom","1px solid #26a69a");
                                        $("#surveyModal div.error").remove();
                                        return true;    
                                    } else {
                                        $('#proceed').attr("disabled",true);
                                        $('#in_ea_mn').css("border-bottom","1px solid #ff1744");
                                        $('#in_ea_mn').after('<div class="error">Please type your 11-digit mobile number (09xxxxxxxxx).</div>');
                                        return false;
                                    }
                                } else {
                                    $('#proceed').attr("disabled",true);
                                    $('#in_ea_mn').css("border-bottom","1px solid #ff1744");
                                    $('#in_ea_mn').after('<div class="error">Please enter a valid phone number.</div>');
                                    return false;
                                }                
                        }
                    }
                    else
                    {
                        var eml = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;       
                    //Validation Email
                        if (eml.test(input) == false) 
                            {
                                $('#proceed').attr("disabled",true);
                                $('#in_ea_mn').css("border-bottom","1px solid #ff1744");
                                $('#in_ea_mn').after('<div class="error">Please enter valid email address..</div>');
                                // $("#<%=txtEmail.ClientID %>").focus();
                                return false;
                            }
                        else{
                                $('#proceed').removeAttr('disabled');
                                $('#in_ea_mn').css("border-bottom","1px solid #26a69a");
                                $("#surveyModal div.error").remove();
                                return true;                   
                        }
                    }

            }

            $('input[type="number"]').on('keypress', function(e){
                return e.metaKey || // cmd/ctrl
                e.which <= 0 || // arrow keys
                e.which == 8 || // delete key
                /[0-9]/.test(String.fromCharCode(e.which)); // numbers
            }); 

            var max_chars = 2;

            $('input[type="number"]').keydown( function(e){
                if ($(this).val().length >= max_chars) { 
                    $(this).val($(this).val().substr(0, max_chars));
                }
            });

            $('.ad-promo-hits').click(function(){
                getUserIP(function(ip){
                    var dateNow = new Date();
                
                    var _dateTimeNow = dateNow.getFullYear() + "-" + (dateNow.getMonth() + 1) + "-" + dateNow.getDate() + " " + 
                    dateNow.getHours() + ":" + dateNow.getMinutes() + ":" + dateNow.getSeconds();

                    var _dateNow = dateNow.getFullYear() + "-" + (dateNow.getMonth() + 1) + "-" + dateNow.getDate();
                            $.ajax({
                                url : "../public/adPromoHits",
                                type: 'GET',
                                data: {
                                    dateTimeNow     : _dateTimeNow,
                                    dateNow         : _dateNow,
                                    ipAddress       : ip 
                                },
                                success: function (data) {

                                if(data != ''){
                                    var image_path = data[0]['image_path'];

                                        $('.ad-promo-banner').attr('src', '../public'+image_path);

                                        $('#adPromoModal').modal('open');
                                    }
                                }
                            });
                });
            });

            function countdownTimer(count) {
                var count = count;
                var countdown = setInterval(function(){
                    $(".timer").html(count);
                    if (count == 0) {
                      clearInterval(countdown);
                      $('#promptModal').modal('close');
                    }
                    count--;
                }, 1000);
            }

        /**
         * Get the user IP throught the webkitRTCPeerConnection
         * @param onNewIP {Function} listener function to expose the IP locally
         * @return undefined
         */
            function getUserIP(onNewIP) { //  onNewIp - your listener function for new IPs
                //compatibility for firefox and chrome
                var myPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
                var pc = new myPeerConnection({
                    iceServers: []
                }),
                noop = function() {},
                localIPs = {},
                ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g,
                key;

                function iterateIP(ip) {
                    if (!localIPs[ip]) onNewIP(ip);
                    localIPs[ip] = true;
                }

                 //create a bogus data channel
                pc.createDataChannel("");

                // create offer and set local description
                pc.createOffer().then(function(sdp) {
                    sdp.sdp.split('\n').forEach(function(line) {
                        if (line.indexOf('candidate') < 0) return;
                        line.match(ipRegex).forEach(iterateIP);
                    });
                    
                    pc.setLocalDescription(sdp, noop, noop);
                }).catch(function(reason) {
                    // An error occurred, so handle the failure to connect
                });

                //listen for candidate events
                pc.onicecandidate = function(ice) {
                    if (!ice || !ice.candidate || !ice.candidate.candidate || !ice.candidate.candidate.match(ipRegex)) return;
                    ice.candidate.candidate.match(ipRegex).forEach(iterateIP);
                };
            }
            // Usage