<?php
session_start();
$admin = true;

include("../../inc/connect.php");
include("../../inc/auth.php");

if (!isset($_GET['id'])) {
    header("Location: pickupAdmin.php");
    exit();
}

$requestId = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['update_item_status'])) {
        $targetItemId = mysqli_real_escape_string($conn, $_POST['target_item_id']);
        $newStatus = mysqli_real_escape_string($conn, $_POST['new_status']);

        $stage = strtolower($newStatus);
        $dateCol = $stage . "_date";

        $check = "SELECT * FROM track_item WHERE ItemId = '$targetItemId'";
        $checkResult = $conn->query($check);

        if ($checkResult->num_rows > 0) {
            $sql = "UPDATE track_item 
                    SET Status = '$newStatus',
                        $dateCol = CURDATE()
                    WHERE ItemId = '$targetItemId'";
        } else {
            $sql = "INSERT INTO track_item (TrackId, ItemId, Status, $dateCol)
                    VALUES (CONCAT('TRK-', '$targetItemId'), '$targetItemId', '$newStatus', CURDATE())";
        }

        $conn->query($sql);

        if ($newStatus == 'Collected') {

    $sqlItem = "
    SELECT UserId, ActivityType
    FROM item
    WHERE ItemId = '$targetItemId'
    ";

    $resultItem = mysqli_query($conn, $sqlItem);
    $itemData = mysqli_fetch_assoc($resultItem);

    if ($itemData) {

        $userId = $itemData['UserId'];
        $activityType = $itemData['ActivityType'];

        $sqlPoint = "
        SELECT PointConfigure
        FROM point_configure
        WHERE ActivityType = '$activityType'
        ";

        $resultPoint = mysqli_query($conn, $sqlPoint);
        $pointData = mysqli_fetch_assoc($resultPoint);

        if ($pointData) {

            $points = $pointData['PointConfigure'];

            mysqli_query($conn, "
            UPDATE user
            SET Points = Points + $points
            WHERE UserId = '$userId'
            ");

            mysqli_query($conn, "
            INSERT INTO activity
            (
                UserId,
                ActivityText,
                ActivityType
            )
            VALUES
            (
                '$userId',
                'You earned $points points from $activityType item collection',
                'User'
            )");

        header("Location: pickupTrackAdmin.php?id=$requestId&selected_item=$targetItemId");
        exit();
    }}}}

    if (isset($_POST['save_modal_data'])) {
        $modalItemId = mysqli_real_escape_string($conn, $_POST['modal_item_id']);
        $modalStage = strtolower($_POST['modal_stage_id']);
        $statusDate = mysqli_real_escape_string($conn, $_POST['modal_status_date']);
        $statusDesc = mysqli_real_escape_string($conn, $_POST['modal_status_desc']);

        $dateCol = $modalStage . "_date";
        $descCol = $modalStage . "_desc";

        $check = "SELECT * FROM track_item WHERE ItemId = '$modalItemId'";
        $checkResult = $conn->query($check);

        if ($checkResult->num_rows > 0) {
            $sql = "UPDATE track_item
                    SET $dateCol = '$statusDate',
                        $descCol = '$statusDesc'
                    WHERE ItemId = '$modalItemId'";
        } else {
            $sql = "INSERT INTO track_item (TrackId, ItemId, $dateCol, $descCol)
                    VALUES (CONCAT('TRK-', '$modalItemId'), '$modalItemId', '$statusDate', '$statusDesc')";
        }

        $conn->query($sql);

        header("Location: pickupTrackAdmin.php?id=$requestId&selected_item=$modalItemId");
        exit();
    }
}

$sql = "SELECT 
            pi.ItemId,
            i.ItemName,
            i.Category,
            COALESCE(t.Status,'Not Started') AS Status,
            t.pending_date,
            t.pending_desc,
            t.collected_date,
            t.collected_desc,
            t.processing_date,
            t.processing_desc,
            t.completed_date,
            t.completed_desc
        FROM pickup_item pi
        JOIN item i ON pi.ItemId = i.ItemId
        LEFT JOIN track_item t ON i.ItemId = t.ItemId
        WHERE pi.RequestId = '$requestId'";

$result = $conn->query($sql);

$urlSelectedItem = isset($_GET['selected_item']) ? $_GET['selected_item'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../image/logo.png">

    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/admin/dashboardAdmin.css">
    <link rel="stylesheet" href="../../style/admin/headerAdmin.css">
    <link rel="stylesheet" href="../../style/admin/sidebarAdmin.css">
    <link rel="stylesheet" href="../../style/admin/pickupTrackAdmin.css">

    <script src="../../js/admin/PickupTrackAdmin.js" defer></script>
    <title>UTeM RecycleHub</title>
</head>

<body>
    <?php include("headerAdmin.php"); ?>

    <div id="main">
        <?php include("sidebarAdmin.php"); ?>

        <div id="content">
            <div class="track-container">
                <div class="track-title">
                    <h2>Track Item Management</h2>
                    <p>
                        Request ID: <?= htmlspecialchars($requestId) ?> ·
                        Manage and track item processing milestones
                    </p>
                </div>

                <div class="track-selector admin-inputs-row">
                    <div class="input-col">
                        <label>Item to Track</label>

                        <select id="itemSelect" data-selected="<?= htmlspecialchars($urlSelectedItem) ?>">
                            <option selected disabled value="">Select Item</option>

                            <?php
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $itemStatus = $row['Status'];
                                    $itemCategory = $row['Category'];

                                    $pDate = !empty($row['pending_date']) ? $row['pending_date'] : '';
                                    $pDesc = !empty($row['pending_desc']) ? $row['pending_desc'] : 'Your item has been added to the system';

                                    $cDate = !empty($row['collected_date']) ? $row['collected_date'] : '';
                                    $cDesc = !empty($row['collected_desc']) ? $row['collected_desc'] : 'Item has been collected from your location';

                                    $prDate = !empty($row['processing_date']) ? $row['processing_date'] : '';
                                    $prDesc = !empty($row['processing_desc']) ? $row['processing_desc'] : 'Item is being processed at our facility';

                                    $cmDate = !empty($row['completed_date']) ? $row['completed_date'] : '';
                                    $cmDesc = !empty($row['completed_desc']) ? $row['completed_desc'] : 'Process has finished successfully';
                            ?>
                                    <option
                                        value="<?= htmlspecialchars($row['ItemId']) ?>"
                                        data-status="<?= htmlspecialchars($itemStatus) ?>"
                                        data-category="<?= htmlspecialchars($itemCategory) ?>"
                                        data-pending-date="<?= htmlspecialchars($pDate) ?>"
                                        data-pending-desc="<?= htmlspecialchars($pDesc) ?>"
                                        data-collected-date="<?= htmlspecialchars($cDate) ?>"
                                        data-collected-desc="<?= htmlspecialchars($cDesc) ?>"
                                        data-processing-date="<?= htmlspecialchars($prDate) ?>"
                                        data-processing-desc="<?= htmlspecialchars($prDesc) ?>"
                                        data-completed-date="<?= htmlspecialchars($cmDate) ?>"
                                        data-completed-desc="<?= htmlspecialchars($cmDesc) ?>">
                                        <?= htmlspecialchars($row['ItemName']) ?> (ITM-<?= htmlspecialchars($row['ItemId']) ?>)
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>


                </div>

                <form id="timelineForm" method="POST" action="">
                    <input type="hidden" name="target_item_id" id="targetItemId">
                    <input type="hidden" name="new_status" id="newStatus">
                    <input type="hidden" name="update_item_status" value="1">

                    <div class="track-card" id="track-card" style="display:none;">
                        <div class="track-header">
                            <div>
                                <h2 id="selectedItemName">Item Name</h2>
                                <p id="selectedItemCategory">Category</p>
                            </div>

                            <span class="status-badge" id="statusBadge">Status</span>
                        </div>

                        <div class="timeline-white-box">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">
                                        <div class="editbtn">
                                            <div>
                                                <h3>Pending</h3>
                                                <p class="timeline-date" id="display-pending-date">📅 Pending</p>
                                                <p class="timeline-desc" id="display-pending-desc">
                                                    Your item has been added to the system
                                                </p>
                                            </div>

                                            <div style="display:flex;gap:8px;">
                                                <button type="button" class="btn-sub" onclick="openEditModal('Pending')">
                                                    + Edit Data
                                                </button>

                                                <div class="action-toggle-container" data-stage="pending">
                                                    <button type="button" class="btn-action" onclick="changeStepStatus('Pending')">
                                                        Mark Done
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">
                                        <div class="editbtn">
                                            <div>
                                                <h3>Collected</h3>
                                                <p class="timeline-date" id="display-collected-date">📅 Pending</p>
                                                <p class="timeline-desc" id="display-collected-desc">
                                                    Item has been collected from your location
                                                </p>
                                            </div>

                                            <div style="display:flex;gap:8px;">
                                                <button type="button" class="btn-sub" onclick="openEditModal('Collected')">
                                                    + Edit Data
                                                </button>

                                                <div class="action-toggle-container" data-stage="collected">
                                                    <button type="button" class="btn-action" onclick="changeStepStatus('Collected')">
                                                        Mark Done
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">
                                        <div class="editbtn">
                                            <div>
                                                <h3>Processing</h3>
                                                <p class="timeline-date" id="display-processing-date">📅 Pending</p>
                                                <p class="timeline-desc" id="display-processing-desc">
                                                    Item is being processed at our facility
                                                </p>
                                            </div>

                                            <div style="display:flex;gap:8px;">
                                                <button type="button" class="btn-sub" onclick="openEditModal('Processing')">
                                                    + Edit Data
                                                </button>

                                                <div class="action-toggle-container" data-stage="processing">
                                                    <button type="button" class="btn-action" onclick="changeStepStatus('Processing')">
                                                        Mark Done
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">
                                        <div class="editbtn">
                                            <div>
                                                <h3>Completed</h3>
                                                <p class="timeline-date" id="display-completed-date">📅 Pending</p>
                                                <p class="timeline-desc" id="display-completed-desc">
                                                    Process has finished successfully
                                                </p>
                                            </div>

                                            <div style="display:flex;gap:8px;">
                                                <button type="button" class="btn-sub" onclick="openEditModal('Completed')">
                                                    + Edit Data
                                                </button>

                                                <div class="action-toggle-container" data-stage="completed">
                                                    <button type="button" class="btn-action" onclick="changeStepStatus('Completed')">
                                                        Mark Done
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="progress-section">
                                <div class="progress-bar">
                                    <div class="progress-fill" id="progressFill"></div>
                                </div>

                                <p class="progress-text" id="progressText">0% complete</p>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editDataPopup" class="popup-modal-overlay" style="display:none;">
        <div class="popup-modal-box">
            <div class="popup-modal-header">
                <h2 id="modalStageTitle">Pending — Add Tracking Data</h2>
            </div>

            <form method="POST">
                <input type="hidden" name="modal_item_id" id="modalItemId">
                <input type="hidden" name="modal_stage_id" id="modalStageId">

                <label>📅 Date</label>
                <input type="date" name="modal_status_date" id="modalStatusDate" required>

                <label>📄 Note</label>
                <textarea name="modal_status_desc" id="modalStatusDesc" rows="3" required></textarea>

                <div class="popup-modal-footer">
                    <button type="button" onclick="closeEditModal()" class="modal-cancel-btn">
                        Cancel
                    </button>

                    <button type="submit" name="save_modal_data" class="modal-save-btn">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>