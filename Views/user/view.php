<p> Your account : </p>
<p> Email : <?= $A_view["EMAIL"] ?> </p>
<p> Name : <?= $A_view["USERNAME"] ?> </p>
<p> Admin status : <?= $A_view["ADMIN"] ? "yes" : "no" ?> </p>

<form method="POST" action="/user/logout">
<input type="submit" value="Se déconnecter">
</form>
