<html>
<body>
  Preferred Location: {{$request->primaryAddress}}<br>
  Preferred Property Type: {{$request->propertyType}}<br>
  Property Number: {{$request->propertyNumber}}<br>
  Lot Area: {{$request->lotArea}}<br>
  Min Price: {{$request->minPrice}}<br>
  Max Price: {{$request->maxPrice}}<br>
  First Name: {{$request->firstName}}<br>
  Last Name: {{$request->lastName}}<br>
  Email Address: {{$request->emailAddress}}<br>
  Contact Number: {{$request->contactNumber}}<br>
  Age: {{$request->age}}<br>
  Gender: {{$request->gender}}<br>
  Occupation: {{$request->occupation}}<br>
  Preferred Schedule: {{$request->schedule}}<br>
  Additional Notes: {{$request->notes}}<br>
</body>
</html>