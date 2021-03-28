<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Note')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <h6 class="h2 d-inline-block mb-0"><?php echo e(__('Note')); ?></h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Note')); ?></li>
        </ol>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h2 class="h3 mb-0"><?php echo e(__('Manage Note')); ?></h2>
                            </div>
                            <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'employee' || \Auth::user()->type == 'client'): ?>
                                <div class="col-auto">
                                <span class="create-btn">
                                    <a href="#" data-url="<?php echo e(route('note.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Note')); ?>" class="btn btn-outline-primary btn-sm">
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
                                <th><?php echo e(__('Created Date')); ?></th>
                                <th><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Files')); ?></th>
                                <th><?php echo e(__('Descrition')); ?></th>
                                <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'employee' || \Auth::user()->type == 'client'): ?>
                                    <th class="text-right"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(\Auth::user()->dateFormat($note->created_at)); ?></td>
                                    <td><?php echo e($note->title); ?></td>
                                    <td>
                                        <?php if(!empty($note->file)): ?>
                                            <a target="_blank" href="<?php echo e(asset(Storage::url('uploads/notes')).'/'.$note->file); ?>"><?php echo e($note->file); ?></a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($note->description); ?></td>
                                    <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'employee' || \Auth::user()->type == 'client'): ?>
                                        <td class="table-actions text-right">
                                            <a href="#" data-url="<?php echo e(route('note.edit',$note->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Note')); ?>" class="table-action" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="#!" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($note->id); ?>').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['note.destroy', $note->id],'id'=>'delete-form-'.$note->id]); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\products-temp\growcrm\resources\views/note/index.blade.php ENDPATH**/ ?>