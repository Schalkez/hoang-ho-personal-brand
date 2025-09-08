jQuery(document).ready(function ($) {
	$form = $(".form");
	// required
	// minlength
	// maxlength
	// email
	// url
	// number
	// equalTo
	$form.each(function (index, el) {
		var $form = $(this);
		$form.submit(function () {
			return false;
		});
		var $inputs = $form.find(".input-text");
		var defaultResponse = {
			success: "Cám ơn! Bạn đã đăng ký thành công!",
			error: "Xin lỗi! Bạn chưa đăng ký thành công!",
		};

		var rules = {};
		var messages = {};

		$inputs.each(function (index, el) {
			var name = $(this).attr("name");
			var rule = {};
			var message = {};
			var data = $(this).data();
			rules[name] = {};
			messages[name] = {};
			if (Object.keys(data).length) {
				Object.keys(data).forEach(function (item, i) {
					if (item.startsWith("rule_")) {
						rule[item.substring(5)] = data[item];
					} else if (item.startsWith("message_")) {
						message[item.substring(8)] = data[item];
					}
				});
			}
			if (Object.keys(rule).length && Object.keys(message).length) {
				rules[name] = rule;
				messages[name] = message;
			}
		});

		window["form_" + index] = $form.validate({
			rules: rules,
			messages: messages,
			submitHandler: function (form) {
				var userData = {};

				var $inputs = $(form).find(".input-text");
				$inputs.each(function (index, el) {
					var name = $(this).attr("name");
					var value = $(this).val();
					if (name == "city" || name == "district" || name == "ward") {
						var index = value.indexOf("_");
						if (index) value = value.slice(index + 1);
					}
					userData[name] = value;
				});

				var loading = bootbox.dialog({
					message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Loading...</div>',
					closeButton: false,
					onEscape: true,
					backdrop: true,
					centerVertical: true,
				});

				$.ajax({
					url: ajaxurl,
					type: "POST",
					dataType: "JSON",
					data: {
						action: "form",
						user: userData,
					},
				})
					.done(function (res) {
						if (res) {
							loading.modal("hide");
							bootbox.dialog({
								message: '<div class="text-center">Thông tin của bạn đã được gửi</div>',
								onEscape: true,
								backdrop: true,
								centerVertical: true,
							});
							$(form)[0].reset();
							$(form).find(".input-text").val("").trigger("change");
						}
					})
					.fail(function (err) {
						var alert = bootbox.alert("Thông tin của bạn chưa được gửi đi.");
						setTimeout(function () {
							alert.modal("hide");
							// $(form)[].reset();
						}, 1000);
					})
					.always(function (load) {});
			},
		});
	});
});
