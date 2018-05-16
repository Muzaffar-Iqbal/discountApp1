<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ site_title }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600"
              rel="stylesheet" type="text/css">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>
        <header class="header">
            <div class="container">
                <div class="row">@include('includes.header')</div>
            </div>
        </header>

        <div class="container" style="text-align:  center;">
            <?php
            $var = '';
            $oldgroup = '';
            $type = '';
            $j = 0;
            $len = count($data);
            $nextQty = '+';
            ?>
            <h2 class="center" style="text-align: center">Discount Groups</h2>
			<div class="main-container">
			@if($len == 0)
				<label>You have not created any discount groups yet. <a href="#" class="add-discount">Create a new discount group</a></label>
			@endif
            @foreach($data as $i=>$row)
            <?php
            $nowQty = $row->qty;
            if ($i == $len - 1) {
                $nextQty = '+';
            } else {
                $nextQty = $data[$i + 1]->qty - 1;
                $nextQty = '-' . $nextQty;
            }
            $i++;
            ?>
            <?php $var = $row->groupTitle ?>
            @if($row->grouType == 1)
            <?php $type = '$'; ?>
            @else
            <?php $type = '%'; ?>
            @endif
            @if($var != $oldgroup)
            <div class="accordDiv">
                <button class="accordion">GROUP: {{$row->groupTitle}}</button>
                <div class="buttons actions">
                    <button class="edit btn" data-id="{{$row->gid}}">Edit</button>
                    <button class="delete btn" data-id="{{$row->gid}}"
                            onclick="deleteGroup({{$row->gid}})">Delete</button>
                </div>
            </div>
			<div class="col-md-12 subacc" style="text-align: left ; font-weight: bold; padding-left: 0px;">
				<div class="col-md-6" style="background-color: #FAF9F8; padding: 5px;">
					<span>QTY</span>
				</div>
				<div class="col-md-6" style="background-color: #FAF9F8; padding: 5px;">
					<span>DISCOUNT</span>
				</div>
			</div>
            @endif
            <?php $oldgroup = $row->groupTitle; ?>
            <div class="row subacc" style="">
				<div class="col-md-6" style="text-align: left; background-color: #FAF9F8; padding: 15px; border-top: 1px solid #ffffff;">
					<span>{{$row->qty}}{{$nextQty}}</span>
				</div>
				<div class="col-md-6" style="text-align: left; background-color: #FAF9F8; padding: 15px; border-top: 1px solid #ffffff;">
					<span>@if($type != '%'){{$type}}{{$row->value}} @else {{$row->value}}{{$type}} @endif</span>
				</div>
				</div>
            @endforeach
			</div>
			
        </div>

        <script type="text/javascript">
			jQuery('.add-discount').click(function (e) {
				e.preventDefault();
				$("#myModalDiscount").modal();
				return false;
			});
            $('.accordion').click(function(){
            $('.accordion').removeClass('active');
            $(this).addClass('active');
            $(this).parent().nextUntil('.accordDiv').toggle();
            });
            function deleteGroup(id)
            {
            var gid = id;
            var r = confirm("By deleting this discount group you will remove it from any products or collections it is associated with.");
            if (r == true) {
            $.ajax({
            url: "{{ url('/') }}/deleteGroup?gid=" + gid,
                    beforeSend: function(){
                    },
                    success: function(data){
                    if (data)
                    {
                    window.location.href = '{{ url("/") }}/create-group';
                    }
                    }
            });
            }
            }


        </script>

        <style type="text/css">
            .qtyRange {
                display: block;
                font-size: 11px;
                margin: 2px 0 0;
                padding: 0 5px;
            }

            .accordDiv {
                position: relative;
            }

            .buttons.actions {
                position: absolute;
                right: 18px;
                top: 5px;
                z-index: 9999;
            }

            .qty-section .form-group {
                margin: 0;
            }

            .qty-section .form-group {
                padding: 10px;
            }

            .title .col-md-6 {
                display: inline-block;
                float: unset;
                margin: 0 0 0 3%;
                padding: 0;
                text-align: left;
                width: 45%;
            }

            .alert {
                border: 1px solid transparent;
                border-radius: 1px;
                margin-bottom: 9px;
                padding: 5px;
            }

            body {
                padding-bottom: 2%;
            }

            .custom-container {
                border: 1px solid #ccc;
                box-shadow: 0 1px 2px #ccc;
                margin-top: 4%;
                padding: 20px;
            }

            br {
                clear: both;
            }

            .qty-title {
                background: rgba(0, 0, 0, 0.05) none repeat scroll 0 0;
                color: #000;
                padding: 7px;
            }

            .qty-section {
                border: 1px solid #ccc;
                padding: 0;
            }

            .qty-section .form-group {
                padding: 10px;
            }

            .qty-section .form-control {
                display: inline-block;
                max-width: 150px;
                width: 100%;
            }
            /*.btn.qtybtns {
              background: #286090 none repeat scroll 0 0;
              color: #fff;
              margin-left: 22px;
              padding: 6px 22px;
              width: 86px;
            }*/
            .btn {
                background: #286090 none repeat scroll 0 0;
                color: #fff;
                margin-left: 22px;
                padding: 6px 22px;
                width: 86px;
            }

            .form-group.row.saveBtn {
                margin-top: 30px;
                text-align: left;
            }

            .form-group {
                padding: 0;
            }

            h4 {
                font-size: 14px;
                font-weight: 600;
                opacity: 0.82;
            }

            .accordion {
                background-color: #eee;
                border: medium none;
                color: #444;
                cursor: pointer;
                font-size: 13px;
                font-weight: normal;
                margin: 1px;
                outline: medium none;
                padding: 11px;
                text-align: left;
                text-transform: uppercase;
                transition: all 0.4s ease 0s;
                width: 100%;
            }

            .subacc {
                display: none;
                padding: 10px;
            }

            .subacc span {
                padding: 16px;
            }

            .panel {
                /*    padding: 0 18px;
            background-color: white;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;*/

            }
			.main-container{
				float: left;
				width: 100%;
			}
			.main-container > div{
				float: left;
				width: 100%;
				padding: 0;
				margin: 0;
			}
        </style>
    </body>
</html>
