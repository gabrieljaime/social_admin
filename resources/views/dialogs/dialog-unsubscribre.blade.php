<dialog id="dialog_unsubscribe" class="mdl-dialog padding-0">
    {!! Form::open( array('action' => array('SubscriptionController@cancel'), 'method' => 'POST','role' => 'form','id'=>'change'))!!}
    <i class="material-icons status mdl-color--white mdl-color-text--red-700">warning</i>
    <h3 class="mdl-dialog__title mdl-color--red-700 mdl-color-text--white text-center-only padding-half-1">
        UnSubscribe


    </h3>

    <div class="mdl-dialog__actions block padding-1-half ">
        <h6 class="center">You will UnSubscribe to our service <br>and your account change to a Free Plan</h6>

        <div class="mdl-grid ">
            <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
                {!! Form::button(trans('dialogs.confirm_modal_button_cancel_text'), array('class' => 'mdl-button mdl-js-button mdl-js-ripple-effect
                mdl-color--grey-400 mdl-color-text--white dialog-close dialog-unsubscribe-close block full-span')) !!}
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">

                {!! Form::button('<span class="mdl-spinner-text">UnSubscribe</span>
                <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner mdl-color-text--white mdl-color-white"></div>', array('class' => 'mdl-button mdl-js-button mdl-js-ripple-effect center mdl-color--red-700 mdl-color-text--white
                mdl-button--raised full-span','type' => 'submit','id' => 'submitUnSubscribe')) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</dialog>