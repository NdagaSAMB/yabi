<!-- resources/views/emails/contact.blade.php -->

<h2>Nouveau message reçu depuis le site</h2>

<p><strong>Nom :</strong> {{ $name }}</p>
<p><strong>Email :</strong> {{ $email }}</p>

<p><strong>Message :</strong></p>
<p>{{ $messageContent }}</p>
