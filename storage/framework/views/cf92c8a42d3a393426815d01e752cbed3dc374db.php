<?php
    $profile=asset(Storage::url('uploads/avatar/'));
?>
<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/module/js/dragula.min.js')); ?>"></script>
    <script>
        !function (a) {

            "use strict";
            var t = function () {
                this.$body = a("body")
            };
            t.prototype.init = function () {

                a('[data-plugin="dragula"]').each(function () {

                    var t = a(this).data("containers"), n = [];

                    if (t) for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]); else n = [a(this)[0]];
                    var r = a(this).data("handleclass");
                    r ? dragula(n, {
                        moves: function (a, t, n) {
                            return n.classList.contains(r)
                        }
                    }) : dragula(n).on('drop', function (el, target, source, sibling) {

                        var order = [];
                        $("#" + target.id + " > div").each(function () {
                            order[$(this).index()] = $(this).attr('data-id');
                        });

                        var id = $(el).attr('data-id');
                        var old_status = $("#" + source.id).attr('data-status');
                        var new_status = $("#" + target.id).attr('data-status');
                        var stage_id = $(target).attr('data-id');

                        $("#" + source.id).parent().find('.count').text($("#" + source.id + " > div").length);
                        $("#" + target.id).parent().find('.count').text($("#" + target.id + " > div").length);

                        $.ajax({
                            url: '<?php echo e(route('project.task.order')); ?>',
                            type: 'POST',
                            data: {task_id: id, stage_id: stage_id, order: order, old_status: old_status, new_status: new_status, "_token": $('meta[name="csrf-token"]').attr('content')},
                            success: function (data) {
                                toastrs('Success', 'task successfully updated', 'success');
                            },
                            error: function (data) {
                                data = data.responseJSON;
                                toastrs('Error', data.error, 'error')
                            }
                        });
                    });
                })
            }, a.Dragula = new t, a.Dragula.Constructor = t
        }(window.jQuery), function (a) {
            "use strict";

            a.Dragula.init()

        }(window.jQuery);
    </script>
    <script>
        $(document).on("change", "#change-project-status select[name=status]", function () {
            $('#change-project-status').submit();
        });
    </script>
    <script>
        $(document).on('click', '.form-checklist', function (e) {
            e.preventDefault();
            $.ajax({
                url: $("#form-checklist").data('action'),
                type: 'POST',
                data: $('#form-checklist').serialize(),
                dataType: 'JSON',
                success: function (data) {
                    toastrs('Success', '<?php echo e(__("Checklist successfully created.")); ?>', 'success');

                    var html = '<li class="media">' +
                        '<div class="media-body">' +
                        '<h5 class="mt-0 mb-1 font-weight-bold"> </h5> ' +
                        '<div class=" custom-control custom-checkbox checklist-checkbox"> ' +
                        '<input type="checkbox" id="checklist-' + data.id + '" class="custom-control-input"  data-url="' + data.updateUrl + '">' +
                        '<label for="checklist-' + data.id + '" class="custom-control-label"></label> ' +
                        '' + data.name + ' </div>' +
                        '<div class="comment-trash" style="float: right"> ' +
                        '<a href="#" class="btn btn-outline btn-sm red text-muted delete-checklist" data-url="' + data.deleteUrl + '">\n' +
                        '                                                            <i class="far fa-trash-alt"></i>' +
                        '</a>' +
                        '</div>' +
                        '</div>' +
                        ' </li>';


                    $("#check-list").prepend(html);
                    $("#form-checklist input[name=name]").val('');
                    $("#form-checklist").collapse('toggle');
                },
            });
        });
        $(document).on("click", ".delete-checklist", function () {
            if (confirm('Are You Sure ?')) {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'JSON',
                    success: function (data) {
                        toastrs('Success', '<?php echo e(__("Checklist successfully deleted.")); ?>', 'success');
                        btn.closest('.media').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            toastrs('Error', data.message, 'error');
                        } else {
                            toastrs('Error', '<?php echo e(__("Some Thing Is Wrong!")); ?>', 'error');
                        }
                    }
                });
            }
        });
        var checked = 0;
        var count = 0;
        var percentage = 0;
        $(document).on("change", "#check-list input[type=checkbox]", function () {
            $.ajax({
                url: $(this).attr('data-url'),
                type: 'PUT',
                data: {_token: $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    toastrs('Success', '<?php echo e(__("Checklist successfully updated.")); ?>', 'success');
                },
                error: function (data) {
                    data = data.responseJSON;
                    toastrs('Error', '<?php echo e(__("Something is wrong.")); ?>', 'error');
                }
            });
            taskCheckbox();
        });


        $(document).on('click', '#form-comment button', function (e) {
            var comment = $.trim($("#form-comment textarea[name='comment']").val());
            var name = '<?php echo e(\Auth::user()->name); ?>';
            if (comment != '') {
                $.ajax({
                    url: $("#form-comment").data('action'),
                    data: {comment: comment, "_token": $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);

                        var html = "<li class='media mb-20'>" +
                            "                    <div class='media-body'>" +
                            "                        <h5 class='mt-0'>" + name + "</h5>" +
                            "                        " + data.comment +
                            "                           <div class='comment-trash' style=\"float: right\">" +
                            "                               <a href='#' class='btn btn-outline btn-sm red text-muted  delete-comment' data-url='" + data.deleteUrl + "' >" +
                            "                                   <i class='far fa-trash-alt'></i>" +
                            "                               </a>" +

                            "                           </div>" +
                            "                    </div>" +
                            "                </li>";


                        $("#comments").prepend(html);
                        $("#form-comment textarea[name='comment']").val('');
                        toastrs('Success', '<?php echo e(__("Comment successfully created.")); ?>', 'success');
                    },
                    error: function (data) {
                        toastrs('Error', '<?php echo e(__("Some thing is wrong.")); ?>', 'error');
                    }
                });
            } else {
                toastrs('Error', '<?php echo e(__("Please write comment.")); ?>', 'error');
            }
        });
        $(document).on("click", ".delete-comment", function () {
            if (confirm('Are You Sure ?')) {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'JSON',
                    success: function (data) {
                        toastrs('Success', '<?php echo e(__("Comment Deleted Successfully!")); ?>', 'success');
                        btn.closest('.media').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            toastrs('Error', data.message, 'error');
                        } else {
                            toastrs('Error', '<?php echo e(__("Some Thing Is Wrong!")); ?>', 'error');
                        }
                    }
                });
            }
        });

        $(document).on('submit', '#form-file', function (e) {
            e.preventDefault();
            $.ajax({
                url: $("#form-file").data('url'),
                type: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    toastrs('Success', '<?php echo e(__("Comment successfully created.")); ?>', 'success');
                    // console.log(data);
                    var delLink = '';

                    if (data.deleteUrl.length > 0) {
                        delLink = "<a href='#' class='text-danger text-muted delete-comment-file'  data-url='" + data.deleteUrl + "'>" +
                            "                                        <i class='dripicons-trash'></i>" +
                            "                                    </a>";
                    }

                    var html = '<li class="media mb-20">\n' +
                        '                                                <div class="media-body">\n' +
                        '                                                    <h5 class="mt-0 mb-1 font-weight-bold"> ' + data.name + '</h5>\n' +
                        '                                                   ' + data.file_size + '' +
                        '                                                    <div class="comment-trash" style="float: right">\n' +
                        '                                                        <a download href="<?php echo e(asset(Storage::url('tasks'))); ?>/' + data.file + '" class="btn btn-outline btn-sm blue-madison">\n' +
                        '                                                            <i class="fa fa-download"></i>\n' +
                        '                                                        </a>' +
                        '<a href=\'#\' class="btn btn-outline btn-sm red text-muted delete-comment"  data-url="' + data.deleteUrl + '"><i class="far fa-trash-alt"></i></a>' +

                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '                                            </li>';
                    $("#comments-file").prepend(html);
                },
                error: function (data) {
                    data = data.responseJSON;
                    if (data.message) {
                        toastrs('Error', data.message, 'error');
                        $('#file-error').text(data.errors.file[0]).show();
                    } else {
                        toastrs('Error', '<?php echo e(__("Some Thing Is Wrong!")); ?>', 'error');
                    }
                }
            });
        });
        $(document).on("click", ".delete-comment-file", function () {

            if (confirm('Are You Sure ?')) {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'JSON',
                    success: function (data) {
                        toastrs('Success', '<?php echo e(__("File successfully deleted.")); ?>', 'success');
                        btn.closest('.media').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            toastrs('Error', data.message, 'error');
                        } else {
                            toastrs('Error', '<?php echo e(__("Some thing is wrong.")); ?>', 'error');
                        }
                    }
                });
            }
        });

    </script>

    <script>

        $(document).on('change', 'select[name=project]', function () {
            var project_id = $(this).val();
            getMilestone(project_id);
            getUser(project_id);
        });

        function getMilestone(project_id) {
            $.ajax({
                url: '<?php echo e(route('project.getMilestone')); ?>',
                type: 'POST',
                data: {
                    "project_id": project_id, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {
                    $('#milestone_id').empty();
                    $('#milestone_id').append('<option value=""><?php echo e(__('Select Milestone')); ?></option>');
                    $.each(data, function (key, value) {
                        $('#milestone_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }

        function getUser(project_id) {
            $.ajax({
                url: '<?php echo e(route('project.getUser')); ?>',
                type: 'POST',
                data: {
                    "project_id": project_id, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {

                    $('#assign_to').empty();
                    $('#assign_to').append('<option value=""><?php echo e(__('Select User')); ?></option>');
                    $.each(data, function (key, value) {

                        $('#assign_to').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Task')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <h6 class="h2 d-inline-block mb-0"><?php echo e(__('Manage Task')); ?></h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e('Task'); ?></li>
        </ol>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo e(Form::open(array('route' => array('project.all.task'),'method'=>'get'))); ?>

                                <div class="row">
                                    <div class="col text-right">
                                        <ul class="nav nav-tabs">
                                            <li><a class="active" data-toggle="tab" href="#taskList"> <?php echo e(__('List')); ?></a></li>
                                            <li><a data-toggle="tab" href="#taskKanban"> <?php echo e(__('Kanban')); ?></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php echo e(Form::label('project', __('Project'))); ?>

                                            <?php echo e(Form::select('project', $projectList,!empty($_GET['project'])?$_GET['project']:'', array('class' => 'form-control custom-select'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <?php echo e(Form::label('status',__('Status'))); ?>

                                        <select class="form-control custom-select" name="status">
                                            <option value=""><?php echo e(__('All')); ?></option>
                                            <?php $__currentLoopData = $stageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php echo e(isset($_GET['status']) && $_GET['status']==$k?'selected':''); ?>> <?php echo e($val); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php echo e(Form::label('priority', __('Priority'))); ?>

                                            <select class="form-control custom-select" name="priority">
                                                <option value=""><?php echo e(__('All')); ?></option>
                                                <?php $__currentLoopData = $priority; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($val); ?>" <?php echo e(isset($_GET['priority']) && $_GET['priority']==$val?'selected':''); ?>> <?php echo e($val); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <?php echo e(Form::label('due_date',__('Due Date'))); ?>

                                        <?php echo e(Form::date('due_date',isset($_GET['due_date'])?$_GET['due_date']:'',array('class'=>'form-control'))); ?>

                                    </div>
                                    <div class="col-auto apply-btn">
                                        <?php echo e(Form::submit(__('Apply'),array('class'=>'btn btn-outline-primary btn-sm'))); ?>

                                        <a href="<?php echo e(route('project.all.task')); ?>" class="btn btn-outline-danger btn-sm"><?php echo e(__('Reset')); ?></a>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div class="card-body1 notes-page">
                        <div class="tab-content">
                            <div id="taskList" class="tab-pane fade in active show">
                                <div class="row">
                                    <div class="col">
                                        <div class="card">
                                            <!-- Card header -->
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col">
                                                        <h2 class="h3 mb-0"><?php echo e(__('Tasks')); ?></h2>
                                                    </div>
                                                    <?php if(\Auth::user()->type=='company'): ?>
                                                        <div class="col-auto">
                                                           <span class="create-btn">
                                                                <a href="#" data-url="<?php echo e(route('project.task.create',0)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Task')); ?>" class="btn btn-outline-primary btn-sm">
                                                                   <i class="fa fa-plus"></i>  <?php echo e(__('Create')); ?>

                                                               </a>
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="table-responsive py-4">
                                                <table class="table table-flush" id="datatable-basic">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th><?php echo e(__('Project')); ?></th>
                                                        <th><?php echo e(__('Title')); ?></th>
                                                        <th><?php echo e(__('Start date')); ?></th>
                                                        <th><?php echo e(__('Due date')); ?></th>
                                                        <th><?php echo e(__('Assigned to')); ?></th>
                                                        <th><?php echo e(__('Priority')); ?></th>
                                                        <th><?php echo e(__('Status')); ?></th>
                                                        <th class="text-right"><?php echo e(__('Action')); ?></th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            if(empty($_GET['status']) && empty($_GET['priority']) && empty($_GET['due_date'])){
                                                                $tasks=$project->tasks;
                                                            }else{
                                                                $tasks=$project->taskFilter($_GET['status'],$_GET['priority'],$_GET['due_date']);
                                                            }
                                                        ?>

                                                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td> <?php echo e($project->title); ?></td>
                                                                <td><?php echo e($task->title); ?></td>
                                                                <td> <?php echo e(\Auth::user()->dateFormat($task->start_date)); ?></td>
                                                                <td> <?php echo e(\Auth::user()->dateFormat($task->due_date)); ?></td>
                                                                <td> <?php echo e(!empty($task->taskUser)?$task->taskUser->name:''); ?></td>
                                                                <td>
                                                                    <?php if($task->priority =='low'): ?>
                                                                        <div class="label label-soft-success font-style"> <?php echo e($task->priority); ?></div>
                                                                    <?php elseif($task->priority =='medium'): ?>
                                                                        <div class="label label-soft-warning font-style"> <?php echo e($task->priority); ?></div>
                                                                    <?php elseif($task->priority =='high'): ?>
                                                                        <div class="label label-soft-danger font-style"> <?php echo e($task->priority); ?></div>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td> <?php echo e(!empty($task->stages)?$task->stages->name:''); ?></td>
                                                                <td class="text-right">
                                                                    <?php if(\Auth::user()->type=='company' || \Auth::user()->type=='employee'): ?>
                                                                        <a href="#" data-url="<?php echo e(route('project.task.show',$task->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Task Detail')); ?>" class="table-action" data-toggle="tooltip" data-original-title="<?php echo e(__('View')); ?>">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                    <?php if(\Auth::user()->type=='company'): ?>
                                                                        <a href="#" data-url="<?php echo e(route('project.task.edit',$task->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Task')); ?>" class="table-action" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>
                                                                        <a href="#!" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('task-delete-form-<?php echo e($task->id); ?>').submit();">
                                                                            <i class="fas fa-trash"></i>
                                                                        </a>
                                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['project.task.destroy', $task->id],'id'=>'task-delete-form-'.$task->id]); ?>

                                                                        <?php echo Form::close(); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="taskKanban" class="tab-pane fade in ">
                                <div class="row">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col">
                                                        <h2 class="h3 mb-0"><?php echo e(__('Tasks')); ?></h2>
                                                    </div>
                                                    <?php if(\Auth::user()->type=='company'): ?>
                                                        <div class="col-auto">
                                                            <span class="create-btn">
                                                                <a href="#" data-url="<?php echo e(route('project.task.create',0)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Task')); ?>" class="btn btn-outline-primary btn-sm">
                                                                   <i class="fa fa-plus"></i>  <?php echo e(__('Create')); ?>

                                                               </a>
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                    $json = [];
                                                    foreach ($stages as $stage){
                                                        $json[] = 'task-list-'.$stage->id;
                                                    }
                                                ?>
                                                <div class="board" data-plugin="dragula" data-containers='<?php echo json_encode($json); ?>'>
                                                    <div class="row">
                                                        <?php $__empty_1 = true; $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                            <?php
                                                                if(empty($_GET['project']) && empty($_GET['priority']) && empty($_GET['due_date'])){
                                                                   $tasks = $stage->allTask;
                                                                }else{
                                                                    $tasks=$stage->allTaskFilter($_GET['project'] , $_GET['priority'],$_GET['due_date']);
                                                                }
                                                            ?>

                                                            <?php  ?>

                                                            <div class="col-lg-3">
                                                                <div class="lead-head">
                                                                    <div class="">
                                                                        <h4><?php echo e($stage->name); ?></h4>
                                                                        <span class="badge"><?php echo e(count($tasks)); ?></span>
                                                                    </div>
                                                                </div>
                                                                <div id="task-list-<?php echo e($stage->id); ?>" data-id="<?php echo e($stage->id); ?>" class="lead-item-body scrollbar-inner">
                                                                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div class="lead-item card mb-2 mt-0" data-id="<?php echo e($task->id); ?>">
                                                                            <a href="#" data-url="<?php echo e(route('project.task.show',$task->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Task Detail')); ?>" class="table-action" data-toggle="tooltip"><h5><?php echo e($task->title); ?></h5></a>

                                                                            <div class="table-actions">
                                                                                <div class="dropdown">
                                                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="fas fa-ellipsis-v"></i>
                                                                                    </a>
                                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(32px, 32px, 0px);">
                                                                                        <?php if(\Auth::user()->type=='company'): ?>
                                                                                            <a class="dropdown-item" href="#" data-url="<?php echo e(route('project.task.edit',$task->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Task')); ?>"> <?php echo e(__('Edit')); ?></a>
                                                                                        <?php endif; ?>

                                                                                        <?php if(\Auth::user()->type=='company'): ?>
                                                                                            <a class="dropdown-item" href="#" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('task-delete-form-<?php echo e($task->id); ?>').submit();"> <?php echo e(__('Delete')); ?></a>

                                                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['project.task.destroy', $task->id],'id'=>'task-delete-form-'.$task->id]); ?>

                                                                                            <?php echo Form::close(); ?>

                                                                                        <?php endif; ?>

                                                                                        <a class="dropdown-item" href="#" data-url="<?php echo e(route('project.task.show',$task->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Task Detail')); ?>" class="table-action" data-toggle="tooltip"> <?php echo e(__('View')); ?></a>

                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <p></p>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <p class="card-text small text-muted">
                                                                                        <i class="far fa-calendar"></i> <?php echo e(\Auth::user()->dateFormat($task->start_date)); ?>

                                                                                    </p>
                                                                                </div>
                                                                                <div class="col text-right">
                                                                                    <p class="card-text small text-muted">
                                                                                        <i class="far fa-calendar"></i> <?php echo e(\Auth::user()->dateFormat($task->due_date)); ?>

                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <p></p>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <a href="#!" data-toggle="tooltip" class="float-left">
                                                                                        <img alt="image" data-toggle="tooltip" data-original-title="<?php echo e(!empty($task->taskUser)?$task->taskUser->name:''); ?>" <?php if($task->taskUser): ?> src="<?php echo e($profile.'/'.$task->taskUser->avatar); ?>" <?php else: ?> src="<?php echo e($profile .'/avatar.png'); ?>" <?php endif; ?> class="rounded-circle profile-widget-picture" width="25">
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <p> <?php echo e($task->taskCompleteCheckListCount()); ?>/<?php echo e($task->taskTotalCheckListCount()); ?></p>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <a href="#" class="task-status low">
                                                                                        <small>
                                                                                            <?php if($task->priority =='low'): ?>
                                                                                                <div class="label label-soft-success font-style"> <?php echo e($task->priority); ?></div>
                                                                                            <?php elseif($task->priority =='medium'): ?>
                                                                                                <div class="label label-soft-warning font-style"> <?php echo e($task->priority); ?></div>
                                                                                            <?php elseif($task->priority =='high'): ?>
                                                                                                <div class="label label-soft-danger font-style"> <?php echo e($task->priority); ?></div>
                                                                                            <?php endif; ?>
                                                                                        </small>
                                                                                    </a>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </div>

                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                            <div class="col-md-12 text-center">
                                                                <h4><?php echo e(__('No data available')); ?></h4>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\products-temp\growcrm\resources\views/project/allTask.blade.php ENDPATH**/ ?>