<html>
<body>
  @if($request->propertyNumber) Property Number: {{$request->propertyNumber}}<br> @endif
  @if($request->firstName) First Name: {{$request->firstName}}<br> @endif
  @if($request->lastName) Last Name: {{$request->lastName}}<br> @endif
  @if($request->fullName) Full Name: {{$request->fullName}}<br> @endif
  @if($request->address) Address: {{$request->address}}<br> @endif
  Email Address: {{$request->emailAddress}}<br>
  Contact Number: {{$request->contactNumber}}<br>
  Message: {{$request->message}}<br>
</body>
</html>