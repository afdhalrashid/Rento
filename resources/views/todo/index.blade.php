@extends('layouts.app')

@section('content')
    <!-- Content Row -->
    <div id="main">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">To Do List</h1>
        </div>
        <div class="row">

            <div class="container page-todo bootstrap snippets bootdeys">
                <div class="col-sm-12 tasks">
                    <div class="task-list" style="overflow-x:auto">
                        <h1 class="d-inline">Tugasan</h1>
                        <div class="float-right">
                            <button class="btn btn-primary btn-sm btn-modal">Tambah Tugasan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('modal.todo.todoModal')
        @include('modal.todo.todoDeleteModal')
        @include('modal.todo.reminder')
    </div>
@endsection


@section('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" />
    <link href="{{ asset('css/todo/todolist.css') }}" rel="stylesheet">
    <style type="text/css">
        #modalReminder {
            z-index: 1054 !important;
        }

        .modal:nth-of-type(even) {
            /*z-index: 102 !important;*/
            /* z-index: 105 !important; */
        }

        .modal-backdrop.show:nth-of-type(even) {
            /*z-index: 101 !important;*/
            /* z-index: 105 !important; */
        }

        .high {
            padding: 3px 0;
        }

    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function() {
            let inputs = $('.form-control');
            inputs.push($('#completed')[0], $('.fa-trash-alt')[0]);
            // inputs.push($('#completed')[0]);

            /*function hideInput(){
                $('form > .row').hide();
            }*/

            function clearForm() {
                $('#body').html("");
                $('.form-control').val("");
                $('form > .row').hide();
                $('form').removeClass('was-validated');
                $('input').removeClass('is-invalid');
                $('span.invalid-feedback').remove();
                /*let inputs = $('.form-control');
                inputs.val('');
                inputs.prop("checked", false);
                // $('.fa-minus-circle').closest('.row').remove();
                $('label[for="tasks"]').siblings('.row').remove();*/
            }

            $(document).on('click', '.datepicker', function(event) {
                event.preventDefault();
                $(this).datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    todayBtn: true,
                });

                $(this).datepicker("show");
            });

            $('.btn-modal').click(function(event) {
                event.preventDefault();
                clearForm();
                // hideInput();
                $('#modalTask').modal();
            });

            // $('.editTask').click(function(event) {
            $('body').on('click', '.editTask', function() {
                event.preventDefault();
                let taskId = $(this).attr('id');
                $('form').attr('action', `/todos/${taskId}`);
                $('form > .row').show();
                editData(taskId);
                $('#modalTask').modal();
            });

            // Show delete confirm message
            $('body').on('click', '.fa-trash-alt', function() {
                event.preventDefault();
                $('.delete').attr('disabled', false);
                // alert("test");
                let taskId = $(this).data('taskid');
                $('#modalDeleteTask .modal-body').text('Anda pasti untuk membuang tuagasan ini?');
                $('.delete').data('delete', taskId);
                $('.delete').data('link', $(this).attr('href'));
                $('#modalDeleteTask').modal();
            });

            // Delete todo Title & Task
            $('body').on('click', '.delete', function() {
                event.preventDefault();
                // let inputDelete = $(this).closest('div').find('input[name=_method]');
                let deleteId = $(this).data('delete');
                let link = $(this).data('link'),
                    _token = $('input[name=_token]').val(),
                    titleId = $('input[name=todoTitle_id]').val(),
                    _method = $(this).closest('div').find('input[name=_method]').val();
                $.ajax({
                        url: `/todos/${deleteId}`,
                        type: 'POST',
                        // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                        data: {
                            _token: _token,
                            _method: _method,
                            titleId: titleId,
                            link: link
                        },
                    })
                    .done(function(data) {
                        console.log(data);
                        $('#modalDeleteTask .modal-body').append(
                            `<p><span class="msg text-success">${data.msg}</span></p>`);
                        $('.delete').attr('disabled', true);

                        if (data.link !== '#') {
                            return getData();
                        }

                        editData(data.titleId);
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });
            });

            $('#modalTask').on('hidden.bs.modal', function(e) {
                clearForm();
                $('form').attr('action', `/todos`);
            })

            function getData(page) {
                $('.high').remove();
                page = (page) ? page : "";

                $.ajax({
                        // url: `/todos?${page}`,
                        url: '/todos_list',
                        type: 'GET',
                        dataType: 'JSON',
                        // data: {
                        //     page: page
                        // },
                    })
                    .done(function(data) {
                        // $('.result').html(data.todoView)
                        $('.task-list').append(data.todoView);
                        // $('.task-list').html(data.todoView)
                        let status = data.status;
                        console.log(data);
                        for (let key in status) {
                            if (status[key]['pending'] && data.get_reminder) {
                                // alert("You still have PENDING task");
                                $('#modalReminder').modal();
                                break;
                            }
                        }
                    })
                    .fail(function(xhlr) {
                        console.log('error');
                    })
                    .always(function() {
                        console.log("complete");
                    });
            }

            function editData(taskId) {
                $.ajax({
                        url: `/todos/${taskId}/edit`,
                        type: 'GET',
                        dataType: 'JSON'
                    })
                    .done(function(data) {
                        console.log(data);
                        let todo = data.todo;
                        $('#body').html(todo);
                        $('#todoTitle_id').val(data.todo_data.title);

                        if (data.todo_data.dateline !== '30/11/-0001') {
                            $('#dateline').val(data.todo_data.dateline);
                        }

                        $('#day_notify').val(data.todo_data.day_notify);
                        // let tasks = todo[0]['tasks'];
                        // $('.completed').prop("checked", true);

                        // $.each($('.completed'), function(index, input){
                        //     if (input.checked) {
                        //         input.parentNode.nextElementSibling.children[0].style.textDecoration = 'line-through';
                        //     }
                        // })
                        completedTask('.completed');

                        /*$.map(inputs, function(item, index) {
                            if (item.hasAttribute('data-taskId')) {
                                item.getAttributeNode('data-taskId').value = todo.id;
                            }

                            if (todo[item.id] != '0000-00-00 00:00:00') {
                                item.value = todo[item.id];
                            }

                            if (item.id == 'completed' && todo[item.id] !== 1) {
                                $(`.${item.id}`).prop("checked", false);
                                completedTask('.completed');
                            }
                        });*/

                        /*for(let prop in todo){
                            if (todo[prop] != '0000-00-00 00:00:00') {
                                $(`#${prop}`).val(todo[prop]);
                            }

                            if (prop == 'completed' && todo[prop] !== 1) {
                                $('#completed').prop("checked", false);
                            }
                        }*/
                    })
                    .fail(function(xhlr) {
                        console.log('error');
                    })
                    .always(function() {
                        // console.log("complete");
                    });
            }

            // Completed checkbox input
            $('body').on('change', '.completed', function() {
                let thisEvent = $(this);
                completedTask(thisEvent);
            });

            function completedTask(event) {
                /*if ($(event).prop("checked") === true) {
                    $(event).closest('.row').find('#tasks').css('textDecoration', 'line-through');
                } else {
                    $(event).closest('.row').find('#tasks').css('textDecoration', '');
                }*/

                $.each($('.completed'), function(index, input) {
                    if (input.checked) {
                        input.parentNode.nextElementSibling.children[0].style.textDecoration =
                            'line-through';
                    } else {
                        input.parentNode.nextElementSibling.children[0].style.textDecoration = '';
                    }
                })
            }

            // Edit Task
            $(document).on('click', '.fa-edit', function(event) {
                event.preventDefault();
                // $(this).closest('.row').find('#tasks').removeAttr('disabled');
                $(this).closest('.row').find('#tasks').prop('disabled', function(i, v) {
                    console.log(!v);
                    return !v;
                });
            });

            // Add Task
            $('body').on('click', '.fa-plus-circle', function(event) {
                event.preventDefault();
                let countTask = $('input.tasks').length;
                let appendTask = $(this).closest('.form-group').append(
                    `@include('modal.todo.addTask', ['add' => 'input'])`);
                let removeDiv = $(appendTask).children().last()
                    .find('.fas.fa-plus-circle')
                    .removeClass('fa-plus-circle')
                    .addClass('fa-minus-circle');
                removeDiv.prop({
                    title: 'Remove',
                })

                removeDiv.closest('.row').find('#tasks').attr('name', `task[${countTask}][tasks]`);
                removeDiv.closest('.row').find('#completed').attr('name',
                    `task[${countTask}][completed]`);
                removeDiv.closest('.row').find('.todo_id').attr('name', `task[${countTask}][todo_id]`);
            });

            // Remove added task
            $('body').on('click', '.fa-minus-circle', function(event) {
                event.preventDefault();
                $(this).closest('.row').remove();
            });

            $('body').on('submit', 'form', function(event) {
                event.preventDefault();
                // console.log($('#task_form').serialize());
                $(this).find('span').remove();
                $('#submit-form').attr('disabled', true);
                $(this).find('input').removeClass('is-invalid');
                console.log($('form').attr('action'));
                console.log($('#task_form').attr('method'));
                // $(this).find('input[type=checkbox]:not(:checked)').prop('checked', true).val(0);

                $.ajax({
                    url: $('#task_form').attr('action'),
                    type: $('#task_form').attr('method'),
                    dataType: 'JSON',
                    data: $('#task_form').serialize(),
                    success: function(data) {
                        console.log(data);
                        $('#task_form').addClass('was-validated');
                        $('#submit-form').after(
                            `<span class="valid-feedback mt-2">${data.msg}</span>`);
                        getData();
                    },
                    error: function(error) {
                        console.log(error);
                        // clearForm();
                        $('form').removeClass('was-validated');
                        // errors = error.responseJSON.errors;

                        if (error.status == 422) {
                            for (let param in errors) {
                                $(`input[name=${param}]`).addClass('is-invalid');
                                $(`input[name=${param}]`).after(
                                    `<span class="invalid-feedback">${errors[param][0]}</span>`
                                );
                            }
                        }
                        console.log("error");
                    },
                    complete: function() {
                        $('#submit-form').attr('disabled', false);
                    }
                });
                // .always(function() {
                //     console.log("complete");
                // });
            });

            $('body').on('click', '.pagination .page-item a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('?')[1];
                getData(page);
            });

            getData();
        });
    </script>
@endsection
