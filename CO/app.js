$(document).ready(function(){

	$("#mainSub").hide();
    var datatabless = $('#datatables').dataTable({
        stateSave: false,
        "paging": false
    });

    datatabless.fnSortNeutral();

    var admin = localStorage.getItem("admin");
    var projId = localStorage.getItem("projId");

    $.getJSON("update_per_second.php", function(data){
        // console.log("SUCCESS!");
        $("#dateMod").html("<p><strong>Last Date Modified: </strong>" + data.dateMod + "</p><p><strong>Date Created: </strong>" + data.dateCre + "</p><p><strong>Admin Last Modified: </strong>" + data.adminName + "</p><button id='btnRefresh' class='btn btn-default'>View Changes</button>");
    });

    function updateValues(){
        $.getJSON("update_per_second.php", function(data){
            $("#dateMod").html("<p><strong>Last Date Modified: </strong>" + data.dateMod + "</p><p><strong>Date Created: </strong>" + data.dateCre + "</p><p><strong>Admin Last Modified: </strong>" + data.adminName + "</p><button id='btnRefresh' class='btn btn-default'>View Changes</button>");
        });
        // location.reload();

    }

    // setInterval(updateValues, 60000);

    // $.getJSON("table_data.php", function(data){
        // console.log(data);
    // function loadDataPerSecond(){
    //     $("#datatables tbody").load("table_data.php");
    // }
    // loadDataPerSecond();
    // });
    megaData(projId);
    function megaData(projId){
        $.getJSON("get_proj.php?id=" + projId, function(data){
            if(data.count >= 1){
                $("#lblProjName").text("PROJECT: Proposed " + data.prod +' '+ data.lvl);
                $("#lblOwner").text("OWNER: " + data.name);
                $("#lblLocation").text("LOCATION: " + data.site);
                $("#forF").attr("data-index", projId);
                $("#forF").val(data.ef);
            }else{
                alert("SQL1 returned a false or zero result");
            }
        });
    }
   
    // function subData(){
    //     // $('#datatables').dataTable().fnClearTable();
    //     // $("#datatables").dataTable().fnDestroy();

    //     $.getJSON("get_main.php", function(data){
    //         $.each(data, function(i, item){
    //             $.getJSON("get_sum.php?id=" + item.a, function(res){
    //                 var html = "<tr><th width=2% style='Text-align: right;'><button id='btnMains' style='float: left;' class='btn btn-default btn-xs' data-index="+item.a+" data-toggle='modal' data-target='#modalMain'>+</button>"+item.a+"</th><th width=25% style='Text-align: Left;'>"+item.b+"</th> <th width=20%></th><th width=5%></th><th width=3%></th><th width=8%></th><th width=10%></th><th width=10%></th><th width=10%></th><th width=10%></th><th width=10%></th><th width=30%>"+res.result+"</th></tr>";
    //                 $("#datatables tbody").append(html);
    //             }); 

    //             $.getJSON("get_main_cat2.php?id=" + item.a, function(cat2){
    //                 $.each(cat2, function(cat2a, cat2b){
    //                     var html1 = "<tr><td style='text-align: right;'><button id='btnCat3' style='float: left;' class='btn btn-default btn-xs' data-index="+item.a+"."+cat2b.c+" data-toggle='modal' data-target='#modalcat3'>+</button>"+item.a+"."+cat2b.c+"</td><td data-index="+cat2b.id1+" name='DESCRIPTION'>"+cat2b.d+"</td><td data-index="+cat2b.id1+" name='DIGOFSPEC'>"+cat2b.DIGOFSPEC1+"</td><td data-index="+cat2b.id1+" name='QTY'>"+cat2b.QTY1+"</td><td data-index="+cat2b.id1+" name='UNIT'>"+cat2b.UNIT1+"</td><td data-index="+cat2b.id1+" name='UM'>"+cat2b.UM1+"</td><td data-index="+cat2b.id1+">"+cat2b.M1+"</td><td data-index="+cat2b.id1+" name='UL'>"+cat2b.UL1+"</td><td data-index="+cat2b.id1+">"+cat2b.L1+"</td><td data-index="+cat2b.id1+">"+cat2b.AMOUNT1+"</td><td></td><td data-index="+cat2b.id1+">"+cat2b.PROFIT_AMOUNT1+"</td></tr>";
    //                     $("#datatables tbody").append(html1); 

    //                     $.getJSON("get_main_cat3.php?id=" + item.a + "." + cat2b.c, function(cat3){
    //                         $.each(cat3, function(cat3a, cat3b){
    //                             var html2 = "<tr><td style='text-align: right;'><button id='btnCat4' style='float: left;' class='btn btn-default btn-xs' data-index="+item.a+"."+cat2b.c+"."+cat3b.e+" data-toggle='modal' data-target='#modalcat4'>+</button>"+item.a+"."+cat2b.c+"."+cat3b.e+"</td><td data-index="+cat3b.id2+" name='DESCRIPTION'>"+cat3b.f+"</td><td data-index="+cat3b.id2+" name='DIGOFSPEC'>"+cat3b.DIGOFSPEC2+"</td><td data-index="+cat3b.id2+" name='QTY'>"+cat3b.QTY2+"</td><td data-index="+cat3b.id2+" name='UNIT'>"+cat3b.UNIT2+"</td><td data-index="+cat3b.id2+" name='UM'>"+cat3b.UM2+"</td><td data-index="+cat3b.id2+">"+cat3b.M2+"</td><td data-index="+cat3b.id2+" name='UL'>"+cat3b.UL2+"</td><td data-index="+cat3b.id2+">"+cat3b.L2+"</td><td data-index="+cat3b.id2+">"+cat3b.AMOUNT2+"</td><td></td><td data-index="+cat3b.id2+">"+cat3b.PROFIT_AMOUNT2+"</td></tr>";
    //                             $("#datatables tbody").append(html2); 

    //                             $.getJSON("get_main_cat4.php?id="+item.a+"."+cat2b.c+"."+cat3b.e, function(cat4){
    //                                 $.each(cat4, function(cat4a, cat4b){
    //                                     var html3 = "<tr><td style='text-align: right;'><button id='btnCat5' style='float: left;' class='btn btn-default btn-xs' data-index="+item.a+"."+cat2b.c+"."+cat3b.e+"."+cat4b.g+" data-toggle='modal' data-target='#modalcat5'>+</button>"+item.a+"."+cat2b.c+"."+cat3b.e+"."+cat4b.g+"</td><td data-index="+cat4b.id3+" name='DESCRIPTION'>"+cat4b.h+"</td><td data-index="+cat4b.id3+" name='DIGOFSPEC'>"+cat4b.DIGOFSPEC3+"</td><td data-index="+cat4b.id3+" name='QTY'>"+cat4b.QTY3+"</td><td data-index="+cat4b.id3+" name='UNIT'>"+cat4b.UNIT3+"</td><td data-index="+cat4b.id3+" name='UM'>"+cat4b.UM3+"</td><td data-index="+cat4b.id3+">"+cat4b.M3+"</td><td data-index="+cat4b.id3+" name='UL'>"+cat4b.UL3+"</td><td data-index="+cat4b.id3+">"+cat4b.L3+"</td><td data-index="+cat4b.id3+">"+cat4b.AMOUNT3+"</td><td></td><td data-index="+cat4b.id3+">"+cat4b.PROFIT_AMOUNT3+"</td></tr>";
    //                                     $("#datatables tbody").append(html3); 

    //                                     $.getJSON("get_main_cat5.php?id="+item.a+"."+cat2b.c+"."+cat3b.e+"."+cat4b.g, function(cat5){
    //                                         $.each(cat5, function(cat5a, cat5b){
    //                                             var html4 = "<tr><td style='text-align: right;'>"+item.a+"."+cat2b.c+"."+cat3b.e+"."+cat4b.g+"."+cat5b.i+"</td><td data-index="+cat5b.id4+" name='DESCRIPTION'>"+cat5b.j+"</td><td data-index="+cat5b.id4+" name='DIGOFSPEC'>"+cat5b.DIGOFSPEC4+"</td><td data-index="+cat5b.id4+" name='QTY'>"+cat5b.QTY4+"</td><td data-index="+cat5b.id4+" name='UNIT'>"+cat5b.UNIT4+"</td><td data-index="+cat5b.id4+" name='UM'>"+cat5b.UM4+"</td><td data-index="+cat5b.id4+">"+cat5b.M4+"</td><td data-index="+cat5b.id4+" name='UL'>"+cat5b.UL4+"</td><td data-index="+cat5b.id4+">"+cat5b.L4+"</td><td data-index="+cat5b.id4+">"+cat5b.AMOUNT4+"</td><td data-index="+cat5b.id4+"></td><td data-index="+cat5b.id4+">"+cat5b.PROFIT_AMOUNT4+"</td></tr>";
    //                                             $("#datatables tbody").append(html4); 
    //                                         });
    //                                     });
    //                                 });
    //                             });
    //                         });
    //                     });
    //                 });
                    
    //             });          
    //         });
    //     });
    // }
    // subData();
    

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
		
		$.getJSON("get_cat1.php?id=" + datas + "." + projId, function(data){
			// console.log(data.lastId);
			var id = parseFloat(data.lastId) + parseFloat(1);
			$("#mainCount").text(data.main+"."+id);
			$("#cat2Desc").attr("data-index", data.main+"."+id);
		});
	});

	$(document).off("submit", "#frmCat2").on("submit", "#frmCat2", function(e){//kapag nasubmit, magiinsert sa database ex. 1.1
        e.preventDefault();

        var data = $("#cat2Desc").attr("data-index");
        var desc = $("#cat2Desc").val();
        // console.log(data);
        if(!desc){
        	alert("Please fill all the Fields!");
        }else{
        	$.ajax({
                type: "POST",
                url: "add_cat2.php",
                dataType: "json",
                data: {
                    items: data,
                    desc: desc,
                    admin: admin,
                    projId: projId
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
		
		$.getJSON("get_cat2.php?id=" + datas + "." + projId, function(data){
            var id = parseFloat(data.lastId) + parseFloat(1);

			$("#cat2Count").text(datas+"."+id);
			$("#cat3Desc").attr("data-index", datas+"."+id);
		});
	});

	$(document).off("submit", "#frmCat3").on("submit", "#frmCat3", function(e){//kapag nasubmit, magiinsert sa database ex. 1.1
        e.preventDefault();

        var data = $("#cat3Desc").attr("data-index");
        var desc = $("#cat3Desc").val();
        // console.log(data);
        if(!desc){
        	alert("Please fill all the Fields!");
        }else{
        	$.ajax({
                type: "POST",
                url: "add_cat3.php",
                dataType: "json",
                data: {
                    items: data,
                    admin: admin,
                    desc: desc,
                    projId: projId
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
		$.getJSON("get_cat3.php?id=" + datas + "." + projId, function(data){
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
                    admin: admin,
                    desc: desc,
                    projId: projId
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
		$.getJSON("get_cat4.php?id=" + datas + "." + projId, function(data){
            var id = parseFloat(data.lastId) + parseFloat(1);
			$("#cat4Count").text(datas+"."+id);
			$("#cat5Desc").attr("data-index", datas+"."+id);
		});
	});

	$(document).off("submit", "#frmCat5").on("submit", "#frmCat5", function(e){//kapag nasubmit, magiinsert sa database ex. 1.1
        e.preventDefault();

        var data = $("#cat5Desc").attr("data-index");
        var desc = $("#cat5Desc").val();
        // console.log(data);
        if(!desc){
        	alert("Please fill all the Fields!");
        }else{
        	$.ajax({
                type: "POST",
                url: "add_cat5.php",
                dataType: "json",
                data: {
                    items: data,
                    admin: admin,
                    desc: desc,
                    projId: projId
                },
                success: function(data){
                    alert(data.text + " HAS BEEN ADDED TO " + data.mainName);
                    location.reload();
                }
            });
        }
    });

	$('#datatables').editableTableWidget();

	$("table td").on("change", function(e){
        e.preventDefault();
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
					admin : admin,
					newValue : newValue
				},
                success: function(){
                    updateValues();
                    megaData(projId);
                    // window.location.replace = window.location.protocol + "//" + window.location.hostname + window.location.pathname + "?proj=" + projId;
                    // document.location.replace = window.location.href;
                }
			});
		}

		$('#message').fadeIn();
		$('#message').fadeOut(4000);

        $(document).off("click", "#btnRefresh").on("click", "#btnRefresh", function(e){
            e.preventDefault();

            document.location.reload(true);
        });
	});
    console.log(window.location.href);
});