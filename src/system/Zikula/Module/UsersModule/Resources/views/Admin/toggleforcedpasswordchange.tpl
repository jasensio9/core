{adminheader}

{if $user_must_change_password}
{gt text='Cancel forced password change for %1$s' tag1=$user_obj.uname|safetext assign='templatetitle'}
{else}
{gt text='Force a change of password for %1$s' tag1=$user_obj.uname|safetext assign='templatetitle'}
{/if}

<div class="z-admin-content-pagetitle">
    {img modname='core' set='icons/small' src='password_expire.png' alt=$templatetitle}
    <h3>{$templatetitle}</h3>
</div>

{if $user_must_change_password}
<p class="alert alert-warning">{gt text='Do you want to cancel the forced password change for %1$s?' tag1=$user_obj.uname|safetext}</p>
{else}
<p class="alert alert-warning">{gt text='Do you want to force a password change during the next login attempt for %1$s?' tag1=$user_obj.uname|safetext}</p>
{/if}

<form class="form-horizontal" role="form" action="{modurl modname='ZikulaUsersModule' type='admin' func='toggleForcedPasswordChange'}" method="post" enctype="application/x-www-form-urlencoded">
    <div>
        <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />
        <input type="hidden" name="userid" value="{$user_obj.uid|safetext}" />
        <input type="hidden" name="user_must_change_password" value="{if $user_must_change_password}0{else}1{/if}" />
        <fieldset>
            <legend>{gt text='Confirmation prompt'}</legend>
            <div class="z-formbuttons z-buttons">
                {if $user_must_change_password}
                {button class="z-btgreen" src='button_ok.png' set='icons/extrasmall' __alt='Yes, cancel the change of password' __title='Yes, cancel the change of password' __text='Yes, cancel the change of password'}
                {else}
                {button class="z-btgreen" src='button_ok.png' set='icons/extrasmall' __alt='Yes, force the change of password' __title='Yes, force the change of password' __text='Yes, force the change of password'}
                {/if}
                <a class="z-btred" href="{modurl modname='ZikulaUsersModule' type='admin' func='view'}" title="{gt text='No'}">{gt text='No'}</a>
            </div>
        </div>
        </fieldset>
    </div>
</form>

{adminfooter}