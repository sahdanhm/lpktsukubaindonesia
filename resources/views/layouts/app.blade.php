<form action="/contact" method="post">
    @csrf
    <input type="text" name="name">
    @error('name')
        <h1>$message</h1>
    @enderror
    <input type="text" name="phone_number">
    @error('phone_number')
    <h1>$message</h1>
@enderror
    <input type="email" name="email">
    @error('email')
    <h1>$message</h1>
@enderror
    <input type="text" name="message">
    @error('message')
    <h1>$message</h1>
@enderror
<button type="submit">add</button>

</form>