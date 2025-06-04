<form method="POST" action="{{ route('postlogin') }}">
    @csrf
    <input name="email" type="email" placeholder="Email" required autofocus>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
