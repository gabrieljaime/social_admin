<dialog id="confirmSub" style="width: 50%;" class="mdl-dialog padding-0">
    <i class="material-icons status mdl-color--white mdl-color-text--green">payment</i>
    <form action="/subscribe_process" method="post" id="payment-form">
    <h1 class="mdl-dialog__title mdl-color--green mdl-color-text--white text-center-only padding-half-1">
    {{__('plans.subscribe_plans')}}
    </h1>

    <div class="mdl-dialog__actions block padding-1-half" style="padding-bottom:0px">
        <h6 style="margin-top: 5px;"> {{__('plans.select_plan')}} </h6>

        @foreach ($plansNoFree as $plan )
            <div id="plan{{$plan->name}}" class="mdl-card mdl-card-twitt mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--12-col-tablet margin-top-0 left "
                style="min-height:0px">
                <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                    <i class="material-icons hidden">face </i> <span class="center">{{__('plans.'.$plan->name)}} {{__('plans.monthly')}}</span>
                </div>
            
                <div class="mdl-card__supporting-text  mdl-color-text--black padding-0 center">
                    <ul class="demo-list-icon mdl-list padding-0" style="margin:0px" >
                        <li class="mdl-list__item padding-0" >
                            <span class="mdl-list__item-primary-content padding-0" >
                                            <i class="material-icons mdl-list__item-icon">attach_money</i>
                                            <strong style="font-size:xx-large">{{$plan->price_m}}</strong> &nbsp/ {{__('plans.month')}}
                                        </span>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
        <div style="clear:both"></div>
        @foreach ($plansNoFree as $plan )
        <div id="plan{{$plan->name}}_y" class="mdl-card mdl-card-twitt mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--12-col-tablet  margin-top-0 left "
            style="min-height:0px">
            <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
             <i   class="material-icons hidden">face </i><span class="center">{{__('plans.'.$plan->name)}} {{__('plans.yearly')}}</span>
            </div>
        
            <div class="mdl-card__supporting-text  mdl-color-text--black padding-1 center">
                <ul class="demo-list-icon mdl-list padding-0" style="margin:0px"">
                    <li class="mdl-list__item padding-0" style="border:none">
                        <span class="mdl-list__item-primary-content padding-0" >
                                        <i class="material-icons mdl-list__item-icon">attach_money</i>
                                        <strong style="font-size:xx-large">{{$plan->price_y}}</strong> &nbsp/ {{__('plans.year')}}
                                        
                        </span>
                      
                    </li>
                    <li class="mdl-list__item center padding-0" style="text-align: center; min-height:0px"><strong class="limegreen">{{__('plans.year_discount')}}</strong></li>
                </ul>
            </div>
        </div>
        @endforeach
        <div id='selected-plan' style="clear:both">
        <h6 style="margin-top: 5px;"> {{__('plans.your_will_sub')}} <strong>Plan Name</strong> </h6>
        <p>Description</p>
        </div>
        {{ csrf_field() }}
        <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop margin-top-0 ">
            
            <h6 style="margin-top: 5px;"> {{__('plans.credit_debit')}} </h6>
           
            
            <div id="card-element" class="mdl-shadow--2dp" >
                <!-- A Stripe Element will be inserted here. -->
            </div>
        
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>

        <div class="mdl-cell mdl-cell--12-col-tablet mdl-cell--12-col-desktop" >
            <div class="mdl-textfield mdl-js-textfield " style="padding: 20px 0px 0px 0px">
                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="accept">
                    <input name="accept" type="checkbox" id="accept" class="mdl-switch__input"  value="off" >
                    <span class="mdl-switch__label">{{__('plans.accept_terms')}}</span>
                </label>
            </div>
        </div>
        <div class="mdl-grid ">
            <div id="acceptt" class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet">
                <button type="submit" id='confirm' class="mdl-button mdl-js-button mdl-js-ripple-effect center mdl-color--grey mdl-color-text--white mdl-button--raised" disabled>
                    <span class="mdl-spinner-text"><span> {{__('plans.subscribe')}} </span> <strong>1</strong></span>
                    <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner mdl-color-text--white mdl-color-white"></div>
                </button>
            </div>
            <div id="toolacept" class="mdl-tooltip mdl-tooltip--top" for="acceptt">
              
               {{__('plans.accept_terms_tool')}}
            </div>
                     
            <div class="mdl-cell mdl-cell--12-col center" style="text-align: center;">
                <span type="" id='cancel'  style="cursor: pointer;">
                    <strong style="color: #8a97a2;">{{__('dialogs.confirm_modal_button_cancel_text')}}</strong>
                </span>
            
            </div>
   
        </div>
    </div>
    </form>
    <script src="https://js.stripe.com/v3/"></script>
</dialog>
