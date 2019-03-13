<!DOCTYPE HTML>
<html>
<head>
<script src="js/push.min.js"></script>
</head>
<body>
<script >
	
Push.create("Hello world!", {
    body: "How's it hangin'?",
    icon: 'icon.png',
    timeout: 4000,
    onClick: function () {
        window.focus();
        this.close();
    }
});
	
</script>

</body>
</html>