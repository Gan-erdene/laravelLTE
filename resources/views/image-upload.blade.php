<!DOCTYPE html>
<html>
<head>
	<title>Laravel 5.3 Image Upload with Validation example</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="panel panel-primary">
  <div class="panel-heading"><h2>Laravel 5.3 Image Upload with Validation example</h2></div>
  <div class="panel-body">

	  	@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if ($message = Session::get('success'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
		        <strong>{{ $message }}</strong>
		</div>
		<img src="/images/{{ Session::get('path') }}">
		@endif

		<form action="{{ url('image-upload') }}" enctype="multipart/form-data" method="POST">
			{{ csrf_field() }}
			<div class="row">

				<div class="col-md-3">
					<div class="user-info-left">
						<img src="/uploads/profileimage/{{$user->profile_image}}" alt="Profile Picture">
						<h2>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</h2>
						<div class="contact">
							<p>

								<span class="file-input btn btn-azure btn-file">
									Профайл зураг <input type="file" id="profileimage" name="profileimage">
								</span>

							</p>
							<p>
								<span class="file-input btn btn-azure btn-file">
									Cover Зураг <input type="file" id="coverName" name="coverName">
								</span>
							</p>
							<ul class="list-inline social">
								<li><a href="#" title="Facebook"><i class="fa fa-facebook-square"></i></a></li>
								<li><a href="#" title="Twitter"><i class="fa fa-twitter-square"></i></a></li>
								<li><a href="#" title="Google Plus"><i class="fa fa-google-plus-square"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-1">Иргэний үнэмлэх</label>
					<div class="col-md-7">
						<div class="input-group">
							<span class="input-group-btn">
									<span class="btn btn-azure btn-file">
											File Uploads <input type="file" id="irgenii" name="irgenii" multiple="">
									</span>
							</span>
							<input type="text" class="form-control" readonly="">
					</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-1">Хорооны тодорхойлолт</label>
					<div class="col-md-7">
						<div class="input-group">
							<span class="input-group-btn">
									<span class="btn btn-azure btn-file">
											File Uploads <input type="file" id="khoroo" name="khoroo" multiple="">
									</span>
							</span>
							<input type="text" class="form-control" readonly="">
					</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-1">Цагдаагийн тодорхойлолт</label>
					<div class="col-md-7">
						<div class="input-group">
							<span class="input-group-btn">
									<span class="btn btn-azure btn-file">
											File Uploads <input type="file" name="tsagdaa" name="tsagdaa" multiple="">
									</span>
							</span>
							<input type="text" class="form-control" readonly="">
					</div>
					</div>
				</div>
				<div class="col-md-12">
					<input type="file" name="image" />
				</div>
				<div class="col-md-12">
					<button type="submit" class="btn btn-success">Upload</button>
				</div>
			</div>
		</form>

  </div>
</div>

</div>

</body>
</html>
