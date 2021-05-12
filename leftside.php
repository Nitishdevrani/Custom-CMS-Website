
<!--Left Side Of Homepage-->

            <div class="col-sm-3 leftside bg-light">

  <!-- Registration Form Area / SignIN Area as Well-->

                <div class="boxchota text-white" style="background-color:rgb(128,0,0);">

                 <div id="show"><?php if ($show!="") {
                   echo '<div class="alert alert-danger" role="alert">'.$show.'</div>';
                  } ?></div>





                <form method="POST">

                  <h2>Register With Us.</h2>

                  <fieldset class="form-group">
                    <label for="username">Your Name</label>
                    <input  class="form-control" type="text" name="username" placeholder="Enter Your Name">
                  </fieldset>

                  <fieldset class="form-group">
                    <label for="email">Email Address</label>
                    <input  class="form-control" type="email" name="email" placeholder="example@gmail.com">
                  </fieldset>

                  <fieldset class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password">
                  </fieldset>

                  <fieldset class="form-group">
                    <label for="password">Confirm Password</label>
                    <input class="form-control" type="password" name="confirmPassword">
                  </fieldset>

                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Role</label>
                      </div>
                      <select class="custom-select" name="Priority" id="inputGroupSelect01">
                        <option selected value="user">User</option>
                        <option value="member" >Member</option>
                        <option value="coAdmin" >co-admin</option>
                        <option value="admin" >Admin</option>
                      </select>
                    </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="stayLoggedIn" value="1"> Stay Logged In
                    </label>

                  </div>

                  <fieldset class="form-group">
                      <input type="hidden" name="signUp" value="1">
                    <input class="btn btn-dark" type="submit" name="submit" value="Sign Up!">
                  </fieldset>
                </form>

              </div>

              <div class=" boxchota bg-info">

               <div id="show"><?php if ($show!="") {
                 echo '<div class="alert alert-danger" role="alert">'.$show.'</div>';
                } ?></div>

                <form method="POST">

                    <h2>Log In!</h2>

                  <fieldset class="form-group">
                    <label for="email">Email Address</label>
                    <input  class="form-control" type="email" name="email" placeholder="Your registered email!">
                  </fieldset>

                  <fieldset class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password">
                  </fieldset>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="stayLoggedIn" value="1"> Stay Logged In
                    </label>

                  </div>

                  <fieldset class="form-group">
                      <input type="hidden" name="signUp" value="0">
                    <input class="btn btn-dark" type="submit" name="submit" value="Log In!">
                  </fieldset>
                </form>

                </div>

  <!--Contact Us Form Area Starts here-->


                <div class=" boxchota bg-warning">

                  <form method="POST">
                  <h2>Any Query! Ask Us.</h2><hr>
                     <div class="form-group">

                       <label for="email">Email address</label>
                       <input type="email" class="form-control" id="yoremail" name="yoremail" placeholder="name@example.com">

                     </div>

                     <div class="form-group">

                       <label for="subject">Subject</label>
                       <input type="text" class="form-control" id="subject" name="subject">

                     </div>

                     <div class="form-group">

                       <label for="message">What would u like to ask us?</label>
                       <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                     </div>

                     <button type="submit" name="send" class="btn btn-primary">send</button>


                  </form>


                </div>
              </div>
