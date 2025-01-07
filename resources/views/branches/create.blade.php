<form action="{{ route('branches.store') }}" method="POST">
    @csrf
    <label for="name">Branch Name:</label>
    <input type="text" name="name" required>
    <label for="address">Address:</label>
    <input type="text" name="address" required>
    <button type="submit">Add Branch</button>
</form>
