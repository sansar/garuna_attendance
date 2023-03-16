@extends('layouts.app-master')
@section('content')
    @if(Request::segment(1)=='edit')
        <h2>Засах</h2>
    @else
        <h2>Шинэ хүн үүсгэх</h2>
    @endif
    <div class="row">
        <div class="">
            <form method="post" action="{{ route('create.post') }}">
                @csrf
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Нэр:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{$edit['name']}}" class="form-control" id="name"
                               required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Утас:</label>
                    <div class="col-sm-10">
                        <input type="number" name="phone" value="{{$edit['phone']}}" class="form-control" id="phone">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Имэйл:</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{$edit['email']}}" class="form-control" id="email">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Урилга:</label>
                    <input type="hidden" name="mail_sent" value="{{$edit['mail_sent']}}">
                    <input type="hidden" name="uid" id="uid" value="{{$edit['uid']}}">
                    <div class="col-sm-10">
                        <button type="button" id="send" class="btn btn-success">{{ $edit['mail_sent'] == 0 ? 'Илгээх' : 'Дахин илгээх'}}</button>
                        <div class="d-inline-block m-lg-2" style="visibility: {{$edit['mail_sent']==0 ? 'hidden' : ''}}" id="is_sent">
                            Илгээсэн
                        </div>
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Ирц</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="attended" name="attended"
                                   value="{{$edit['attended']}}"
                                   @if($edit['attended']==1) checked @endif>
                            <label class="form-check-label" for="gridCheck1">
                                Ирсэн
                            </label>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-success">Хадгалах</button>
                @if(Request::segment(1)=='edit')
                    <button type="button" id="delete" class="btn btn-danger">Устгах</button>
                @endif
                <a href="/" type="button" class="btn btn-secondary">Буцах</a>
            </form>
        </div>
    </div>
    <script>
        function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };

        $(document).ajaxSend(function () {
            $("#overlay").fadeIn(300);
        });
        $(function () {
            if (getUrlParameter('a') !== false) {
                Swal.fire(
                    'OK дарж ирц бүртгэнэ үү!',
                    $('#name').val(),
                    'success'
                ).then(function () {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    $.ajax({
                        url: "/attend",
                        type: "POST",
                        dataType: "json",
                        data: {
                            uid: $('#uid').val(),
                        },
                    }).done(function (data) {
                        location.replace('/');
                    }).fail(function () {
                        Swal.fire(
                            'Ажмилтгүй боллоо!',
                            'Дахин оролдоно уу.',
                            'error'
                        ).then(function () {
                            $("#overlay").fadeOut(300);
                        });
                    });
                });
            }
        });
        $("#paid_date").flatpickr({});
        $("#attended").change(function () {
            let checkbox = $(this);
            if (checkbox.is(":checked")) {
                checkbox.val("1");
            } else {
                checkbox.val("0");
            }
        })
        $('#delete').click(function () {
            Swal.fire({
                title: 'Устгахдаа итгэлтэй байна уу?',
                text: "Энэ үйлдлийг буцааж болохгүй!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Үгүй',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Тиймээ, устга!',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });

                    $.ajax({
                        url: "/delete",
                        type: "POST",
                        dataType: "json",
                        data: {
                            uid: $('#uid').val(),
                        },
                    })
                        .done(function (data) {
                            Swal.fire(
                                'Устгасан!',
                                'Энэ бүртгэл устсан.',
                                'success'
                            ).then(function () {
                                location.replace('/');
                            });
                        })
                        .fail(function () {
                            Swal.fire(
                                'Ажмилтгүй боллоо!',
                                'Дахин оролдоно уу.',
                                'error'
                            ).then(function () {
                                $("#overlay").fadeOut(300);
                            });
                        });
                }
            })
        });

        $('#send').click(function () {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                url: "/email_send",
                type: "POST",
                dataType: "json",
                data: {
                    uid: $('#uid').val(),
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val(),
                    link: location.href,
                },
            })
                .done(function (data) {
                    setTimeout(function () {
                        $("#overlay").fadeOut(300);
                    }, 500);

                    Swal.fire(
                        'Имэйл илгээсэн!',
                        'илгээсэн.',
                        'success'
                    ).then(function () {
                        $('#is_sent').css('visibility', '');
                    });
                })
                .fail(function () {
                    Swal.fire(
                        'Алдаа гарлаа!',
                        'Мэйл хаягийг шалгана уу.',
                        'error'
                    ).then(function () {
                        $("#overlay").fadeOut(300);
                        $('#email').focus();
                    });
                });
        });
    </script>
@endsection
