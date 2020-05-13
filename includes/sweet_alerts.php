
<!DOCTYPE html>
<html>
	<head>
		<?php include_once "links.php"; ?>	

	</head>

	<body>
	
		
	</body>
</html>

<script>
    function successAlert(iconSymbol, titleText){
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        
        Toast.fire({
            icon: iconSymbol,
            title: titleText
        })
    }

    function warningAlert(iconSymbol, titleText){
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        
        Toast.fire({
            icon: iconSymbol,
            title: titleText
        })
    }
	
	function successAlertMain(iconSymbol, titleText){
		const Toast = Swal.mixin({
                                toast: true,
                                position: 'center',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            if(status != ""){
                                Toast.fire({
                                    icon: iconSymbol,
                                    title: titleText
                                })
                            }
	}

</script>