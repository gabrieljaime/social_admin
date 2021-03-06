<dialog id="dialog_change" class="mdl-dialog padding-0 ">

    <i class="material-icons status mdl-color--white mdl-color-text--green">cached</i>
    <h3 class="mdl-dialog__title mdl-color--green mdl-color-text--white text-center-only padding-half-1">
        Change your Plan


    </h3>

    <div class="mdl-dialog__actions block padding-1-half ">
        <h6 class="center">You will update your subscription plan. <br>Congratulation</h6>

        <div class="mdl-grid ">
            <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
                {!! Form::button(trans('dialogs.confirm_modal_button_cancel_text'), array('class' => 'mdl-button mdl-js-button mdl-js-ripple-effect
                mdl-color--grey-400 mdl-color-text--white dialog-close dialog-change-close block full-span')) !!}
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">

                {!! Form::button('<span class="mdl-spinner-text">Change</span>
                <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner mdl-color-text--white mdl-color-white"></div>', array('class' => 'mdl-button mdl-js-button mdl-js-ripple-effect center mdl-color--primary mdl-color-text--white
                mdl-button--raised full-span','type' => 'submit','id' => 'submitChange')) !!}
            </div>
        </div>
    </div>

</dialog>