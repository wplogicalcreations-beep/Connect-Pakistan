<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/embassy-logo.svg') }}" type="image/x-icon">
    <title>Business Sign Up - Embassy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div class="container-fluid">
    <!-- Step 1: Company Identity -->
    @include('organization-signup.signup-form.company-identity')
    <!-- Step 2: Company Information -->
    @include('organization-signup.signup-form.company-info')
    <!-- Step 3: Product Information -->
    @include('organization-signup.signup-form.product-info')

    <!-- Step 4: Service Information -->
   @include('organization-signup.signup-form.service-info')

    <!-- Step 5: Setup Passcode -->
    @include('organization-signup.signup-form.setup-passcode')

    <!-- Step 6: Preview Business Details -->
    @include('organization-signup.signup-form.preview')
</div>

@include('organization-signup.signup-form.modal')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('js/script.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const dashboardUrl = "{{ route('company.dashboard') }}";
    const companyIdentityUrl = "{{ route('organization.company-identity') }}";
    const companyInfoUrl = "{{ route('organization.company-info') }}";
    const productInfoUrl = "{{ route('organization.products-info') }}";
    const serviceInfoUrl = "{{ route('organization.service-info') }}";
    const passcodeUrl = "{{ route('organization.store-passcode') }}";
    const accountVerificationUrl = "{{ route('organization.account-verification') }}";
    const getOrganizationDataUrl = "{{ route('organization.get-data') }}";
</script>
</body>

</html>
