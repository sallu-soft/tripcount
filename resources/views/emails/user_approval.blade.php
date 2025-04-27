<!-- resources/views/emails/user_registration_request.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Account Registration Request</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>Thank you for registering with us. Your account has been approved.</p>
    <p>Your access token is given below<br>
        Email: {{ $user->email }}<br>
    </p>
    <p style="margin-top: 10px; ">Please note that these login details are confidential and should not be shared with anyone else.<br> You can change your password anytime from your TripCount profile settings.

        If you have any questions or need any assistance,<br> please feel free to contact us at [contact.sallusoft@gmail.com] or [01812215760]. We are always happy to help you.<br>
        
        Thank you for choosing TripCount as your accounting software partner. We hope you enjoy using TravCount and find it useful for your travel business.</p>
    <p style="margin-top: 10px">Thanks & Regards<br>

        --<br>
        Tripcount<br>
        
        Sallu Software Solution Ltd.<br>
        291, Fokirapool Jomidar Palace(Lift-07) Motijheel Dhaka-1000<br>
        Mob :+88 01812215760  +88 01776105863 | web : www.tripcount.net </p>
    <!-- Add more content as needed -->
</body>
</html>
