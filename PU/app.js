$(document).ready(function(){
	$("#mainSub").hide();

	var datatabless = $('#datatables').dataTable({
		// "scrollY":        "300px",
        // "scrollCollapse": true,
        stateSave: false,
        "paging": false
	});

	datatabless.fnSortNeutral();

    function updateValues(){
        $.getJSON("update_per_second.php", function(data){
            console.log("SUCCESS!");
        });
    }

    setInterval(updateValues, 6000);

	$(document).off("submit", "#formMain").on("submit", "#formMain", function(e){
		e.preventDefault();
		var mainName = $("input[name=mainScope]").val();
		// console.log(mainName);
		$.ajax({
			type: "POST",
			url: "add_cost_category.php",
			dataType: "json",
			data: {
				mainName: mainName
			},
			success: function(data){
				if(data.prompt == 1){
					alert("Already in database!");
					// window.location.href;
				}else if(data.prompt == 0){
					alert("Successfully Added!");
					// window.location.href;
                    location.reload();

				}
			}
		});
	});

    $(document).off("keyup", "#forF").on("keyup", "#forF", function(e){
        e.preventDefault();
        var projId = $(this).attr("data-index");
        var ef = $("#forF").val();
        
        if(!ef){
            alert("Please Fill all The fields!");
        }else{
            $.ajax({
                type: "POST",
                url: "add_f.php",
                data: {
                    projId : projId,
                    data : ef
                },
                success: function(){
                    // alert("Success!");
                }
            });
        }
    });

	$(document).off("click", "#btnMains").on("click", "#btnMains", function(e){
		e.preventDefault();
		var datas = $(this).attr("data-index");
		
		$.getJSON("get_cat1.php?id=" + datas, function(data){
			console.log(data.lastId);
			var id = parseFloat(data.lastId) + parseFloat(1);
			$("#mainCount").text(data.main+"."+id);
			$("#cat2Desc").attr("data-index", data.main+"."+id);
		});
	});

	$(document).off("submit", "#frmCat2").on("submit", "#frmCat2", function(e){//kapag nasubmit, magiinsert sa database ex. 1.1
        e.preventDefault();

        var data = $("#cat2Desc").attr("data-index");
        var desc = $("#cat2Desc").val();
        console.log(data);
        if(!desc){
        	alert("Please fill all the Fields!");
        }else{
        	$.ajax({
                type: "POST",
                url: "add_cat2.php",
                dataType: "json",
                data: {
                    items: data,
                    desc: desc
                },
                success: function(data){
                    alert(data.text + " HAS BEEN ADDED TO " + data.mainName);
                    location.reload();
                }
            });
        }
    });

    $(document).off("click", "#btnCat3").on("click", "#btnCat3", function(e){
		e.preventDefault();
		var datas = $(this).attr("data-index");
		
		$.getJSON("get_cat2.php?id=" + datas, function(data){
            var id = parseFloat(data.lastId) + parseFloat(1);

			$("#cat2Count").text(datas+"."+id);
			$("#cat3Desc").attr("data-index", datas+"."+id);
		});
	});

	$(document).off("submit", "#frmCat3").on("submit", "#frmCat3", function(e){//kapag nasubmit, magiinsert sa database ex. 1.1
        e.preventDefault();

        var data = $("#cat3Desc").attr("data-index");
        var desc = $("#cat3Desc").val();
        console.log(data);
        if(!desc){
        	alert("Please fill all the Fields!");
        }else{
        	$.ajax({
                type: "POST",
                url: "add_cat3.php",
                dataType: "json",
                data: {
                    items: data,
                    desc: desc
                },
                success: function(data){
                    alert(data.text + " HAS BEEN ADDED TO " + data.mainName);
                    location.reload();
                }
            });
        }
    });

    $(document).off("click", "#btnCat4").on("click", "#btnCat4", function(e){
		e.preventDefault();
		var datas = $(this).attr("data-index");
		$.getJSON("get_cat3.php?id=" + datas, function(data){
            var id = parseFloat(data.lastId) + parseFloat(1);
			$("#cat3Count").text(datas+"."+id);
			$("#cat4Desc").attr("data-index", datas+"."+id);
		});
	});

	$(document).off("submit", "#frmCat4").on("submit", "#frmCat4", function(e){//kapag nasubmit, magiinsert sa database ex. 1.1
        e.preventDefault();

        var data = $("#cat4Desc").attr("data-index");
        var desc = $("#cat4Desc").val();
        console.log(data);
        if(!desc){
        	alert("Please fill all the Fields!");
        }else{
        	$.ajax({
                type: "POST",
                url: "add_cat4.php",
                dataType: "json",
                data: {
                    items: data,
                    desc: desc
                },
                success: function(data){
                    alert(data.text + " HAS BEEN ADDED TO " + data.mainName);
                    location.reload();
                }
            });
        }
    });

    $(document).off("click", "#btnCat5").on("click", "#btnCat5", function(e){
		e.preventDefault();
		var datas = $(this).attr("data-index");
		$.getJSON("get_cat4.php?id=" + datas, function(data){
            var id = parseFloat(data.lastId) + parseFloat(1);
			$("#cat4Count").text(datas+"."+id);
			$("#cat5Desc").attr("data-index", datas+"."+id);
		});
	});

	$(document).off("submit", "#frmCat5").on("submit", "#frmCat5", function(e){//kapag nasubmit, magiinsert sa database ex. 1.1
        e.preventDefault();

        var data = $("#cat5Desc").attr("data-index");
        var desc = $("#cat5Desc").val();
        console.log(data);
        if(!desc){
        	alert("Please fill all the Fields!");
        }else{
        	$.ajax({
                type: "POST",
                url: "add_cat5.php",
                dataType: "json",
                data: {
                    items: data,
                    desc: desc
                },
                success: function(data){
                    alert(data.text + " HAS BEEN ADDED TO " + data.mainName);
                    location.reload();
                }
            });
        }
    });
	$('#datatables').editableTableWidget();

	$("table td").on("change", function(){
		var column = $(this).attr('name'),
		id = $(this).closest('td').attr('data-index'),
		newValue = $(this).text()
		console.log(column);
		console.log(id);
		console.log(newValue);

		if(!column){
            alert("You cannot edit this area!");
			return false;
		}else if(!newValue){
            return false;
        }else{
			$.ajax({
				type: "POST",
				url: "update_sub.php",
				data: {
					column : column,
					id : id,
					newValue : newValue
				},
			});
		}

		$('#message').fadeIn();
		$('#message').fadeOut(4000);
	});
});