function showCommunity() {

    document.getElementById("communityBoard").style.display = "block";
    document.getElementById("utemBoard").style.display = "none";

    document.getElementById("communityBtn").classList.add("active-tab");
    document.getElementById("utemBtn").classList.remove("active-tab");
}

function showUTeM() {

    document.getElementById("communityBoard").style.display = "none";
    document.getElementById("utemBoard").style.display = "block";

    document.getElementById("utemBtn").classList.add("active-tab");
    document.getElementById("communityBtn").classList.remove("active-tab");
}

document.querySelectorAll(".redeem-btn").forEach(button => {

    button.addEventListener("click", function() {

        let rewardName = this.dataset.reward;

        document.getElementById("rewardText").innerHTML =
            rewardName + " redeemed successfully!";

        document.getElementById("redeemPopup").style.display = "flex";

    });

});

function closePopup() {

    document.getElementById("redeemPopup").style.display = "none";

}