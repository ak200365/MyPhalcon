<h1>Users</h1>

{% if users.count() > 0 %}

<table class="table table-bordered table-hover">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Login</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <!-- <th>Balance</th> -->
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="5">Users quantity: {{ users.count() }}</td>
        </tr>
    </tfoot>
    <tbody>
        {% for user in users %}
        <tr>
            <td>{{ user.id }}</td>
            <td>{{ user.login }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.role }}</td>
            <!-- <td>{{ user.balance }}</td> -->
        </tr>
        {% endfor %}
    </tbody>
</table>

<!--
{% for user in users %}
UPDATE `users` SET `password`='<?php echo md5($user->password) ?>' WHERE `login`='{{user.login}}';<br>
{% endfor %}
-->

{% endif %}