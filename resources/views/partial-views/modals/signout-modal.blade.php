<x-confirmation-modal 
    modal-id="signedOutConfirmation"
    heading="Confirm Signout"
    message="Are you really want to sign-out?"
    :action="route('admin.auth.signout.submit')"
    action-text="Yes, Sign me Out"
/>
