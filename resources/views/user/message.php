<?php
$errors = $_SESSION['errors'];
$num = 1;
?>
<?php if (isset($errors)) : ?>
    <ul>
        <?php foreach ($errors as $error) : ?>
            <li id="idl"><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/message/add" method="POST">
    <table>
        <tbody>
        <tr>
            <td>User Name</td>
            <td><input type="text" name="username" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" required></td>
        </tr>
        <tr>
            <td>Homepage</td>
            <td><input type="text" name="homepage"></td>
        </tr>
        <tr>
            <td>CAPTCHA</td>
            <td>
                <input type="text" name="captcha" required>
                <img src="/resources/views/user/captcha.php" />
            </td>
        </tr>
        <tr>
            <td>Text</td>
            <td><textarea type="text" name="message" required></textarea></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="Отправить">
            </td>
        </tr>
        </tbody>
    </table>
</form>

<hr>

<table id="tbl">
    <thead>
        <th>ID</th>
        <th><a href="/message/page/<?= $current ?>/sort/<?= $pattern['username'] ?>">User Name</a></th>
        <th><a href="/message/page/<?= $current ?>/sort/<?= $pattern['email'] ?>">Email</a></th>
        <th>Text</th>
        <th>Homepage</th>
        <th>CAPTCHA</th>
        <th>Browser</th>
        <th>IP</th>
        <th><a href="/message/page/<?= $current ?>/sort/<?= $pattern['date'] ?>">Date</a></th>
    </thead>
    <tbody>
        <?php foreach ($messages as $message): ?>
            <tr>
                <td><?= $num++ ?></td>
                <td><?= $message['username'] ?></td>
                <td><?= $message['email'] ?></td>
                <td><?= $message['text'] ?></td>
                <td><?= $message['homepage'] ?></td>
                <td><?= $message['captcha'] ?></td>
                <td><?= $message['browser'] ?></td>
                <td><?= $message['ip'] ?></td>
                <td><?= $message['date'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php foreach ($pages as $page): ?>
    <a href="/message/page/<?= $page ?>/sort/desc_id"><?= $page ?></a>
<?php endforeach; ?>