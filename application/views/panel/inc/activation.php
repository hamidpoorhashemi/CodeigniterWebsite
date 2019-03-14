
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form>
                    <div class="login-form-head">
                        <h4>Activate your account</h4>
                        <p>If you try before,You can find your Activation code from Your SMS Inbox.</p>
                        <p>Activatioan code will send to you in 60 Seconds</p>
                        <button class="btn btn-info" type="button" id="sendVcodeBtn" onclick="sendVode(60)" name="button">Send Me Activation Code Again. </button>
                        <div class="timer" style="color:white;font-size:1.2em">60</div>
                        <script type="text/javascript">

                        function sendVode(timer){
                           $("#sendVcodeBtn").hide();
var interval = setInterval(function() {
  timer--;
  $('.timer').text(timer);
  if (timer === 0){
    $("#sendVcodeBtn").show();
    $('.timer').text(timer);
    clearInterval(interval);

  }
}, 1000);
apiAjax('<?=$link['ajax']['api']?>','sendVcode')

}
sendVode(60);
                        </script>
                    </div>
                    <div class="login-form-body">

                                            <div class="form-gp">
                                                <label for="exampleInputPassword1">Activation code</label>
                                                <input autocomplete="new-password" type="text" id="activationcode" >
                                                <i class="ti-lock"></i>
                                            </div>

                                            <div class="submit-btn-area">
                                                <button   onclick="loginBtnEvent()"  id="form_submit" type="button">Activate<i class="ti-arrow-right"></i></button>
                                                  <script type="text/javascript">
                                                    function loginBtnEvent(){
                                                      dataArray={
                                                        "activationcode":$("#activationcode").val()
                                                      };
                                                      apiAjax('<?=$link['ajax']['api']?>','active',dataArray,'activeAction','<?=$link['dashboard']?>')
                                                    }
                                                  </script>


                                            </div>
                        <div class="form-footer text-center mt-5">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->
