<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Plan')); ?>

<?php $__env->stopSection(); ?>
<?php
    $dir= asset(Storage::url('uploads/plan'));
?>
<?php $__env->startSection('breadcrumb'); ?>
    <h6 class="h2 d-inline-block mb-0"><?php echo e(__('Plan')); ?></h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Plan')); ?></li>
        </ol>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h2 class="h3 mb-0"><?php echo e(__('Manage Plans')); ?></h2>
                            </div>
                            <?php if(\Auth::user()->type=='super admin'): ?>
                                <div class="col-auto">
                                    <span class="create-btn">
                                        <a href="#" data-url="<?php echo e(route('plan.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Plan')); ?>" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-plus"></i>  <?php echo e(__('Create')); ?>

                                        </a>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row plan-div">
                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-4 col-md-4">
                                    <div class="plan-item">
                                        <h4> <?php echo e($plan->name); ?></h4>
                                        <div class="img-wrap">
                                            <img class="plan-img" src="<?php echo e($dir.'/'.$plan->image); ?>">
                                        </div>
                                        <h3>
                                            <?php echo e(env('CURRENCY_SYMBOL').$plan->price); ?>

                                        </h3>
                                        <p class="font-style"><?php echo e($plan->duration); ?></p>
                                        <div class="text-center mb-10">
                                            <?php if(\Auth::user()->type=='company' && \Auth::user()->plan == $plan->id): ?>

                                                <div class="text-left">
                                                    <p><?php echo e(__('Expired : ')); ?> <?php echo e(\Auth::user()->plan_expire_date ? \Auth::user()->dateFormat(\Auth::user()->plan_expire_date):__('Unlimited')); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="text-left">
                                            <p><?php echo e($plan->description); ?></p>
                                        </div>
                                        <ul>
                                            <li>
                                                <i class="fas fa-user-tie"></i>
                                                <p><?php echo e($plan->max_employee); ?> <?php echo e(__('Employee')); ?></p>
                                            </li>
                                            <li>
                                                <i class="fas fa-user-plus"></i>
                                                <p><?php echo e($plan->max_client); ?> <?php echo e(__('Client')); ?></p>
                                            </li>
                                            <li>
                                                <?php if( \Auth::user()->type == 'super admin'): ?>
                                                    <a title="Edit Plan" href="#" class="btn btn-outline-primary btn-sm" data-url="<?php echo e(route('plan.edit',$plan->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Plan')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i class="far fa-edit"></i></a>
                                                <?php endif; ?>

                                                <?php if(($plan->id != \Auth::user()->plan) && \Auth::user()->type!='super admin' ): ?>
                                                    <?php if($plan->price > 0): ?>
                                                        <a title="Buy Plan" class="btn btn-outline-primary btn-sm" href="<?php echo e(route('stripe',\Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>">
                                                            <i class="fa fa-cart-plus"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="view-btn"><?php echo e(__('Free')); ?></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                                                    <div class="text-center">
                                                        <a class="view-success-btn">
                                                            <a class="view-btn"> <?php echo e(__('Active')); ?></a>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\products-temp\growcrm\resources\views/plan/index.blade.php ENDPATH**/ ?>