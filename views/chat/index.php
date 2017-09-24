<?php
use yii\helpers\Html;

$this->title = 'Chat';
$userBlock = 'User Nick Name';
?>
<div class="container">
    <div class="col-md-8 page-header well well-sm">
        <h4><?php echo Html::encode($this->title) ?></h4>
        <div class="alert alert-danger" id="alert-message">

        </div>
        <?php echo $this->render('_user_nick_form', ['user' => $user]);?>

        <?php echo $this->render('_message_form', ['user' => $user, 'chat' => $chat]);?>
        <div>
            <table class="table" id="table-message-list">
                <?php foreach ($messages as $message) : ?>
                    <tr>
                        <td class="col-md-3 nick-message">
                            <span><strong><?php echo $message->getUser()->getNick(); ?></strong></span>
                        </td>
                        <td class="col-md-9">
                            <p><strong><?php echo $message->getDate(); ?> </strong></p>
                            <?php echo $message->message; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="col-md-4 page-header well well-sm">
        <h4><?php echo Html::encode($userBlock) ?></h4>
        <table class="table table-bordered" id="table-nick-list">
            <thead>
            <tr>
                <th>Nick</th>
                <th>City</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($createdUsers as $createdUser) : ?>
                    <tr class="<?php echo $createdUser->id === $currentUserId ? 'list-group-item-info' : '' ?>"
                        id="user-<?php echo $createdUser->id; ?>">
                        <td><?php echo $createdUser->nick; ?></td>
                        <td><?php echo $createdUser->city; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
