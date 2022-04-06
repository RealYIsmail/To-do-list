import Button from '@material-ui/core/Button';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogTitle from '@material-ui/core/DialogTitle';
import PropTypes from 'prop-types';
import React, {useContext} from 'react';

function DeleteDialog(props){
    return(
        <Dialog fullWidth={true} maxWidth={'sm'} open={props.open}>
            <DialogTitle>Are you sure you want to delete this to-do?</DialogTitle>
            <DialogContent>
                // task
            </DialogContent>
            <DialogActions>
                <Button onClick={() => {props.setDeleteConfirmationIsShown(false)}}>Cancel</Button>
                <Button onClick={}>Delete</Button> 
            </DialogActions>
        </Dialog>
    );
}
DeleteDialog.propTypes = {
    open: PropTypes.bool.isRequired,
    setDeleteConfirmationIsShown: PropTypes.func.isRequired,
};
export default DeleteDialog;