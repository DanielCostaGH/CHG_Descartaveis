<h1>tela create</h1>
<form method="POST" action="{{ route('admin.store') }}">
    @csrf

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <button type="submit">Create Admin</button>
</form>