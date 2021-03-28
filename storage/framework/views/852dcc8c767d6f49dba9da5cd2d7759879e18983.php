<?php $__env->startSection('page-title'); ?>
    <?php echo e($emailTemplate->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/module/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/module/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <h6 class="h2 d-inline-block mb-0"> <?php echo e($emailTemplate->name); ?></h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('email_template.index')); ?>"><?php echo e(__('Email Templates')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"> <?php echo e($emailTemplate->name); ?></li>
        </ol>
    </nav>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::model($emailTemplate, array('route' => array('email_template.update', $emailTemplate->id), 'method' => 'PUT'))); ?>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <?php echo e(Form::label('name',__('Name'))); ?>

                                <?php echo e(Form::text('name',null,array('class'=>'form-control font-style','disabled'=>'disabled'))); ?>

                            </div>
                            <div class="form-group col-md-5">
                                <?php echo e(Form::label('from',__('From'))); ?>

                                <?php echo e(Form::text('from',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

                            </div>
                            <?php echo e(Form::hidden('lang',$currEmailTempLang->lang,array('class'=>''))); ?>

                            <div class="form-group col-md-2 my-auto">
                                <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary'))); ?>

                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="nav-wrapper email-nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 <?php echo e(($emailTemplate->slug=='lead_assign')?'active':''); ?>" id="lead-tab" data-toggle="tab" href="#lead" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Lead')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 <?php echo e(($emailTemplate->slug=='deal_assign')?'active':''); ?>  " id="deal-tab" data-toggle="tab" href="#deal" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Deal')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 <?php echo e(($emailTemplate->slug=='send_estimation')?'active':''); ?> " id="estimation-tab" data-toggle="tab" href="#estimation" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Estimation')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 <?php echo e(($emailTemplate->slug=='create_project' || $emailTemplate->slug=='project_assign' || $emailTemplate->slug=='project_finished')?'active':''); ?> " id="project-tab" data-toggle="tab" href="#project" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Project')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 <?php echo e(($emailTemplate->slug=='task_assign')?'active':''); ?> " id="task-tab" data-toggle="tab" href="#task" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Project Task')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 <?php echo e(($emailTemplate->slug=='send_invoice'||  $emailTemplate->slug=='invoice_payment_recored')?'active':''); ?> " id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Invoice')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 <?php echo e(($emailTemplate->slug=='credit_note')?'active':''); ?> " id="credit_note-tab" data-toggle="tab" href="#credit_note" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Credit Note')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 <?php echo e(($emailTemplate->slug=='create_support')?'active':''); ?> " id="support-tab" data-toggle="tab" href="#support" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Support')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 <?php echo e(($emailTemplate->slug=='create_contract')?'active':''); ?> " id="contract-tab" data-toggle="tab" href="#contract" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Contract')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 <?php echo e(($emailTemplate->slug=='create_user')?'active':''); ?>" id="other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Other')); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="shadow email-header-type">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade <?php echo e(($emailTemplate->slug=='lead_assign')?'show active':''); ?>" id="lead" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="row">
                                        <p class="col-4"><?php echo e(__('Lead Name')); ?> : <span class="pull-right text-primary">{lead_name}</span></p>
                                        <p class="col-4"><?php echo e(__('Lead Email')); ?> : <span class="pull-right text-primary">{lead_email}</span></p>
                                        <p class="col-4"><?php echo e(__('Lead Subject')); ?> : <span class="pull-right text-primary">{lead_subject}</span></p>
                                        <p class="col-4"><?php echo e(__('Lead Pipeline')); ?> : <span class="pull-right text-primary">{lead_pipeline}</span></p>
                                        <p class="col-4"><?php echo e(__('Lead Stage')); ?> : <span class="pull-right text-primary">{lead_stage}</span></p>
                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo e(($emailTemplate->slug=='deal_assign')?'show active':''); ?>" id="deal" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="row">
                                        <p class="col-4"><?php echo e(__('Deal Name')); ?> : <span class="pull-right text-primary">{deal_name}</span></p>
                                        <p class="col-4"><?php echo e(__('Deal Pipeline')); ?> : <span class="pull-right text-primary">{deal_pipeline}</span></p>
                                        <p class="col-4"><?php echo e(__('Deal Stage')); ?> : <span class="pull-right text-primary">{deal_stage}</span></p>
                                        <p class="col-4"><?php echo e(__('Deal Status')); ?> : <span class="pull-right text-primary">{deal_status}</span></p>
                                        <p class="col-4"><?php echo e(__('Deal Price')); ?> : <span class="pull-right text-primary">{deal_price}</span></p>
                                        <p class="col-4"><?php echo e(__('Deal Stage')); ?> : <span class="pull-right text-primary">{deal_stage}</span></p>
                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo e(($emailTemplate->slug=='send_estimation')?'show active':''); ?>" id="estimation" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="row">
                                        <p class="col-4"><?php echo e(__('Estimation Name')); ?> : <span class="pull-right text-primary">{estimation_id}</span></p>
                                        <p class="col-4"><?php echo e(__('Estimation Client')); ?> : <span class="pull-right text-primary">{estimation_client}</span></p>
                                        <p class="col-4"><?php echo e(__('Estimation Category')); ?> : <span class="pull-right text-primary">{estimation_category}</span></p>
                                        <p class="col-4"><?php echo e(__('Estimation Issue Date')); ?> : <span class="pull-right text-primary">{estimation_issue_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Estimation Expiry Date')); ?> : <span class="pull-right text-primary">{estimation_expiry_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Estimation Status')); ?> : <span class="pull-right text-primary">{estimation_status}</span></p>
                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo e(($emailTemplate->slug=='create_project' || $emailTemplate->slug=='project_assign' || $emailTemplate->slug=='project_finished')?'show active':''); ?>" id="project" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="row">
                                        <p class="col-4"><?php echo e(__('Project Title')); ?> : <span class="pull-right text-primary">{project_title}</span></p>
                                        <p class="col-4"><?php echo e(__('Project Category')); ?> : <span class="pull-right text-primary">{project_category}</span></p>
                                        <p class="col-4"><?php echo e(__('Project Price')); ?> : <span class="pull-right text-primary">{project_price}</span></p>
                                        <p class="col-4"><?php echo e(__('Project Client')); ?> : <span class="pull-right text-primary">{project_client}</span></p>
                                        <p class="col-4"><?php echo e(__('Project Assign User')); ?> : <span class="pull-right text-primary">{project_assign_user}</span></p>
                                        <p class="col-4"><?php echo e(__('Project Start Date')); ?> : <span class="pull-right text-primary">{project_start_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Project Due Date')); ?> : <span class="pull-right text-primary">{project_due_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Project Lead')); ?> : <span class="pull-right text-primary">{project_lead}</span></p>
                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo e(($emailTemplate->slug=='task_assign')?'show active':''); ?>" id="task" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="row">
                                        <p class="col-4"><?php echo e(__('Project')); ?> : <span class="pull-right text-primary">{project}</span></p>
                                        <p class="col-4"><?php echo e(__('Task Title')); ?> : <span class="pull-right text-primary">{task_title}</span></p>
                                        <p class="col-4"><?php echo e(__('Task Priority')); ?> : <span class="pull-right text-primary">{task_priority}</span></p>
                                        <p class="col-4"><?php echo e(__('Task Start Date')); ?> : <span class="pull-right text-primary">{task_start_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Task Due Date')); ?> : <span class="pull-right text-primary">{task_due_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Task Stage')); ?> : <span class="pull-right text-primary">{task_stage}</span></p>
                                        <p class="col-4"><?php echo e(__('Task Assign User')); ?> : <span class="pull-right text-primary">{task_assign_user}</span></p>
                                        <p class="col-4"><?php echo e(__('Task Description')); ?> : <span class="pull-right text-primary">{task_description}</span></p>
                                    </div>
                                </div>

                                <div class="tab-pane fade <?php echo e(($emailTemplate->slug=='send_invoice' || $emailTemplate->slug == 'invoice_payment_recored')?'show active':''); ?>" id="invoice" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="row">
                                        <p class="col-4"><?php echo e(__('Invoice Number')); ?> : <span class="pull-right text-primary">{invoice_id}</span></p>
                                        <p class="col-4"><?php echo e(__('Invoice Client')); ?> : <span class="pull-right text-primary">{invoice_client}</span></p>
                                        <p class="col-4"><?php echo e(__('Invoice Issue Date')); ?> : <span class="pull-right text-primary">{invoice_issue_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Invoice Due Date')); ?> : <span class="pull-right text-primary">{invoice_due_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Invoice Status')); ?> : <span class="pull-right text-primary">{invoice_status}</span></p>
                                        <p class="col-4"><?php echo e(__('Invoice Total')); ?> : <span class="pull-right text-primary">{invoice_total}</span></p>
                                        <p class="col-4"><?php echo e(__('Invoice Sub Total')); ?> : <span class="pull-right text-primary">{invoice_sub_total}</span></p>
                                        <p class="col-4"><?php echo e(__('Invoice Due Amount')); ?> : <span class="pull-right text-primary">{invoice_due_amount}</span></p>
                                        <p class="col-4"><?php echo e(__('Invoice Status')); ?> : <span class="pull-right text-primary">{invoice_status}</span></p>
                                        <p class="col-4"><?php echo e(__('Invoice Payment Recorded Total')); ?> : <span class="pull-right text-primary">{payment_total}</span></p>
                                        <p class="col-4"><?php echo e(__('Invoice Payment Recorded Date')); ?> : <span class="pull-right text-primary">{payment_date}</span></p>

                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo e(($emailTemplate->slug=='credit_note')?'show active':''); ?>" id="credit_note" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="row">
                                        <p class="col-4"><?php echo e(__('Invoice Number')); ?> : <span class="pull-right text-primary">{invoice_id}</span></p>
                                        <p class="col-4"><?php echo e(__('Date')); ?> : <span class="pull-right text-primary">{credit_note_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Invoice Client')); ?> : <span class="pull-right text-primary">{invoice_client}</span></p>
                                        <p class="col-4"><?php echo e(__('Amount')); ?> : <span class="pull-right text-primary">{credit_amount}</span></p>
                                        <p class="col-4"><?php echo e(__('Description')); ?> : <span class="pull-right text-primary">{credit_description}</span></p>
                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo e(($emailTemplate->slug=='create_support')?'show active':''); ?>" id="support" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="row">
                                        <p class="col-4"><?php echo e(__('Ticket Title')); ?> : <span class="pull-right text-primary">{support_title}</span></p>
                                        <p class="col-4"><?php echo e(__('Ticket Assign User')); ?> : <span class="pull-right text-primary">{assign_user}</span></p>
                                        <p class="col-4"><?php echo e(__('Ticket Priority')); ?> : <span class="pull-right text-primary">{support_priority}</span></p>
                                        <p class="col-4"><?php echo e(__('Ticket End Date')); ?> : <span class="pull-right text-primary">{support_end_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Ticket Description')); ?> : <span class="pull-right text-primary">{support_description}</span></p>
                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo e(($emailTemplate->slug=='create_contract')?'show active':''); ?>" id="contract" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="row">
                                        <p class="col-4"><?php echo e(__('Contract Subject')); ?> : <span class="pull-right text-primary">{contract_subject}</span></p>
                                        <p class="col-4"><?php echo e(__('Contract Client')); ?> : <span class="pull-right text-primary">{contract_client}</span></p>
                                        <p class="col-4"><?php echo e(__('Contract Value')); ?> : <span class="pull-right text-primary">{contract_value}</span></p>
                                        <p class="col-4"><?php echo e(__('Contract Start Date')); ?> : <span class="pull-right text-primary">{contract_start_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Contract End Date')); ?> : <span class="pull-right text-primary">{contract_end_date}</span></p>
                                        <p class="col-4"><?php echo e(__('Contract Description')); ?> : <span class="pull-right text-primary">{contract_description}</span></p>
                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo e(($emailTemplate->slug=='create_user')?'show active':''); ?>" id="other" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="row">
                                        <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-right text-primary">{app_name}</span></p>
                                        <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                        <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                        <p class="col-4"><?php echo e(__('Email')); ?> : <span class="pull-right text-primary">{email}</span></p>
                                        <p class="col-4"><?php echo e(__('Password')); ?> : <span class="pull-right text-primary">{password}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="language-wrap">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 language-list-wrap">
                                    <div class="language-list">
                                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item">
                                                    <a href="<?php echo e(route('manage.email.language',[$emailTemplate->id,$lang])); ?>" class="nav-link <?php echo e(($currEmailTempLang->lang == $lang)?'active':''); ?>"><?php echo e(Str::upper($lang)); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 language-form-wrap">
                                    <?php echo e(Form::model($currEmailTempLang, array('route' => array('store.email.language',$currEmailTempLang->parent_id), 'method' => 'PUT'))); ?>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <?php echo e(Form::label('subject',__('Subject'))); ?>

                                            <?php echo e(Form::text('subject',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

                                        </div>
                                        <div class="form-group col-12">
                                            <?php echo e(Form::label('content',__('Email Message'))); ?>

                                            <?php echo e(Form::textarea('content',$currEmailTempLang->content,array('class'=>'summernote-simple','required'=>'required','rows'=>5))); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <?php echo e(Form::hidden('lang',null)); ?>

                                        <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary'))); ?>

                                    </div>
                                    <?php echo e(Form::close()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\products-temp\growcrm\resources\views/email_templates/show.blade.php ENDPATH**/ ?>