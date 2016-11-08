
<div class="card-block center">
  <h4 class="m-b-0">
    <span class="icon-text">{{ trans('strings.signup') }}</span>
  </h4>
  <p class="text-muted">{{ trans('strings.signup_user') }}</p>
  <form id="signupForm" action="/frontend/signup" method="post" role="form">
    <div class="form-group">
      <input type="text" name="firstname" class="form-control" placeholder="{{trans('strings.first_name')}}">
    </div>
    <div class="form-group">
      <input type="text" name="lastname" class="form-control" placeholder="{{trans('strings.last_name')}}">
    </div>
    <div class="form-group">
      <input type="email" name="email" class="form-control" placeholder="{{trans('strings.email_address')}}">
    </div>
    <div class="form-group">
      <input type="password" name="password" class="form-control" placeholder="{{trans('strings.password')}}">
    </div>
    <div class="form-group">
      <input type="password" id="repassword" name="repassword" class="form-control" placeholder="{{trans('strings.repassword')}}">
    </div>
    <button type="submit" class="btn btn-azure">{{ trans('strings.signup') }}</button>
  </form>
</div>
<script src="/frontend/assets/js/jquery.1.11.0.validate.min.js"></script>
<script>
$(document).ready(function () {
  jQuery.validator.addMethod("equals", function(value, element) {
    return this.optional(element) || value === $('#repassword').val();
  }, "{{trans('strings.valid_repassword')}}");

  $('#signupForm').validate({ // initialize the plugin
      rules: {
          firstname: {
              required: true,
          },
          lastname:{
            required: true
          },
          email:{
            required: true, email: true,
          },
          password:{
            required: true,equals:true
          }
      },
      messages:{
        firstname: {
            required: "{{trans('strings.require_first_name')}}",
        },
        lastname: {
            required: "{{trans('strings.require_last_name')}}",
        },
        email:{
          required: "{{trans('strings.require_email')}}",
          email: "{{trans('strings.format_email')}}",
        },
        password:{
          required: "{{trans('strings.require_password')}}",
        }
      },
      highlight: function(element, error) {

        // add a class "has_error" to the element
        $(element).closest('.form-group').addClass('has-error');
      },
      unhighlight: function(element) {
          $(element).parent().removeClass('has-error');
      },
    errorPlacement: function (error, element) {
      $(error).closest('label').addClass('control-label');
      if (element.parent('.input-group').length || element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
          error.insertAfter(element.parent());
      } else {
          error.insertAfter(element);
      }
    },
      submitHandler: function (form) { // for demo
            form.submitHandler();
        }
  });

});
</script>
