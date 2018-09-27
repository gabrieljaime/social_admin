<dialog id="dialog_resume" class="mdl-dialog padding-0 ">
    {!! Form::open( array('action' => array('SubscriptionController@resume'), 'method' => 'POST','role' => 'form','id'=>'resume'))!!}
    <i class="material-icons status mdl-color--white mdl-color-text--green">restore</i>
    <h3 class="mdl-dialog__title mdl-color--green mdl-color-text--white text-center-only padding-half-1">
        Resume your subscription


    </h3>

    <div class="mdl-dialog__actions block padding-1-half ">
        <h6 class="center">You will resume your subscription. <br>Congratulation</h6>

        <div class="mdl-grid ">
            <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
                {!! Form::button(trans('dialogs.confirm_modal_button_cancel_text'), array('class' => 'mdl-button mdl-js-button mdl-js-ripple-effect
                mdl-color--grey-400 mdl-color-text--white dialog-close dialog-resume-close block full-span')) !!}
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">

                {!! Form::button('<span class="mdl-spinner-text">Resume</span>
                <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner mdl-color-text--white mdl-color-white"></div>', array('class' => 'mdl-button mdl-js-button mdl-js-ripple-effect center mdl-color--primary mdl-color-text--white
                mdl-button--raised full-span','type' => 'submit','id' => 'submitResume')) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</dialog>