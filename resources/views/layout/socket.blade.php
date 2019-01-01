<script type="text/javascript">
    $(function() {
        let steps = [];
        let text = '';
        let inputOptions = {};

        Echo.private('new-member.{{ auth()->id() }}')
        .listen('.add.member', (data) => {
            invitationAlert(data.invitation);
        });

        Echo.private('invitation-respond.{{ auth()->id() }}')
        .listen('.invitation.respond', (data) => {
            respondAlert(data.invitation);
        });

        async function init(invitations, responds) {
            await Promise.all(invitations.map(insertInvitationSteps));
            await Promise.all(responds.map(insertRespondSteps));
            swal.queue(steps);
        }

        init(@json(session('invitations')), @json(session('responds')));

        function insertRespondSteps(respond) {
            text = `Your friend, ${respond.user_to.name.toUpperCase()} (${respond.user_to.email}) has ${(respond.status == 1) ? 'accepted' : 'refused'} your invitation to join ${respond.project.project_name.toUpperCase()} Project`;

            steps.push(
                {
                    title: 'Respond',
                    text: text,
                    type: 'info',
                    onClose: () => {
                        $.ajax({
                            method: 'POST',
                            url: '{{ url('project/deleteInvitation') }}',
                            data: {
                                invitation_id: respond.id,
                                _token: '{{ csrf_token() }}'
                            }
                        });
                    }
                }
            );
        }

        function insertInvitationSteps(invitation) {
            text = `You got invitation from ${invitation.user_from.name.toUpperCase()} (${invitation.user_from.email}) to join ${invitation.project.project_name.toUpperCase()} Project`;

            inputOptions = {
                0 : 'Refuse',
                1 : 'Accept',
                2 : 'Let me think first' 
            };

            steps.push(
                {
                    title: 'Invitation',
                    text: text,
                    type: 'info',
                    input: 'radio',
                    allowOutsideClick: false,
                    inputOptions: inputOptions,
                    inputValidator: (choose) => {
                        return new Promise((resolve) => {
                            if (choose === null) {
                                resolve('Your friend need to know your respond');
                            } 
                            else if(choose == 2) {
                                resolve();
                            } 
                            else {
                               $.ajax({
                                    method: 'POST',
                                    url: '{{ url('project/invitation') }}',
                                    data: {
                                        choose: choose,
                                        project_id : invitation.project_id,
                                        invitation_id : invitation.id,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: () => {
                                        Swal({
                                            type: 'success',
                                            title: `You ${(choose == 1) ? 'Accept' : 'Refuse'} ${invitation.project.project_name.toUpperCase()} Project`
                                        }).then(() => {
                                            resolve();
                                        });
                                    },
                                    error: (xhr) => {
                                        Swal({
                                            type: 'error',
                                            title: 'Error while processing data'
                                        }).then(() => {
                                            resolve();
                                        });
                                    }
                                }); 
                            }
                        });
                    }
                }
            );
        }

        function respondAlert(respond) {
            text = `Your friend, ${respond.user_to.name.toUpperCase()} (${respond.user_to.email}) has ${(respond.status == 1) ? 'accepted' : 'refused'} your invitation to join ${respond.project.project_name.toUpperCase()} Project`;

            Swal({
                title: 'Respond',
                text: text,
                type: 'info',
                onClose: () => {
                    $.ajax({
                        method: 'POST',
                        url: '{{ url('project/deleteInvitation') }}',
                        data: {
                            invitation_id: respond.id,
                            _token: '{{ csrf_token() }}'
                        }
                    });
                }
            });
        }

        function invitationAlert(invitation) {
            text = `You got invitation from ${invitation.user_from.name.toUpperCase()} (${invitation.user_from.email}) to join ${invitation.project.project_name.toUpperCase()} Project`;

            Swal({
                title: 'Invitation',
                text: text,
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#7fff7a',
                cancelButtonColor: '#ff0000',
                confirmButtonText: 'Accept',
                cancelButtonText: 'Refuse'
            }).then((result) => {
                let choose = null;

                if(result.value) {
                    choose = 1;
                } 
                else if(result.dismiss === Swal.DismissReason.cancel) {
                    choose = 0;
                }

                if(choose != null) {
                    $.ajax({
                        method: 'POST',
                        url: '{{ url('project/invitation') }}',
                        data: {
                            choose: choose,
                            project_id : invitation.project_id,
                            invitation_id : invitation.id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: () => {
                            Swal({
                                type: 'success',
                                title: `You ${(choose == 1) ? 'Accept' : 'Refuse'} ${invitation.project.project_name.toUpperCase()} Project`
                            });
                        },
                        error: (xhr) => {
                            Swal({
                                type: 'error',
                                title: 'Error while processing data'
                            });
                        }
                    });
                }
            });
        }
    });
</script>