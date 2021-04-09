<?php $__env->startSection('content'); ?>
    
    <div class="header">
        <div class="container">
            <div class="header-body text-center">
                <div class="row justify-content-center">
                    <a class="navbar-brand" href="#">
                        <img src="<?php echo e(asset(Storage::url('uploads/logo/linkzen-full-white.png'))); ?>" height="220px" class="auth-logo">
                    </a>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">

                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small><?php echo e(__('Sign in with credentials')); ?></small>
                        </div>
                        <?php echo e(Form::open(array('route'=>'login','method'=>'post','id'=>'loginForm','class'=> 'login-form' ))); ?>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <?php echo e(Form::text('email',null,array('class'=>'form-control form-control-solid placeholder-no-fix','placeholder'=>__('Enter Your Email')))); ?>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error invalid-email text-danger" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <?php echo e(Form::password('password',array('class'=>'form-control form-control-solid placeholder-no-fix','placeholder'=>__('Enter Your Password')))); ?>

                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error invalid-password text-danger" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="custom-control custom-control-alternative custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="custom-control-label" for=" customCheckLogin">
                                <span class="text-muted"><?php echo e(__('Remember me')); ?></span>
                            </label>
                        </div>
                        <div class="text-center">
                            <?php echo e(Form::submit(__('Login'),array('class'=>'btn btn-primary my-4','id'=>'saveBtn'))); ?>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <?php if(Route::has('password.request')): ?>
                            <a class="text-light" href="<?php echo e(route('change.langPass',$lang)); ?>">
                                <?php echo e(__('Forgot Your Password?')); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-6 text-right">
                        <a href="<?php echo e(route('register',$lang)); ?>" class="text-light"><?php echo e(__('Register')); ?></a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <?php echo e((Utility::getValByName('footer_text')) ? Utility::getValByName('footer_text') :config('app.name', 'CRMGo')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\products-temp\growcrm\resources\views/auth/login.blade.php ENDPATH**/ ?>