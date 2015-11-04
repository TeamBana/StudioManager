function editRow(i, id)
{
    table = document.getElementsByTagName("table")[0];
    cells = table.getElementsByTagName("td");

    cells[1+(8*i)].innerHTML = '<form method="post" action="" name="modifyItem" id="modItem"> <input type="submit" class="btn btn-primary" name="update" value="Update"/> </form>';

    var name = cells[2+(8*i)].innerHTML;
    cells[2+(8*i)].innerHTML = '<input type="hidden" form="modItem" name="itemID" value="'+id+'"/><input class="form-control" type="text" form="modItem" name="itemName" value="'+name+'" required/>';

    var qty = cells[3+(8*i)].innerHTML;
    cells[3+(8*i)].innerHTML = '<input class="form-control" type="number" form="modItem" name="itemQty" value="'+qty+'" required/>';

    var desc = cells[4+(8*i)].innerHTML;
    cells[4+(8*i)].innerHTML = '<input class="form-control" type="text" form="modItem" name="itemDesc" value="'+desc+'" required/>';

    var status = cells[5+(8*i)].innerHTML;
    cells[5+(8*i)].innerHTML = '<select class="form-control" form="modItem" id="status" name="itemStatus"> <option value="In repair">In Repair</option> <option value="Available">Available</option></select>';

    document.getElementById("status").value = status;

    var disabled = document.getElementsByClassName("disableAllOnClick");

    for(var i; i < disabled.length; i++)
        disabled[i].disabled = true;



}

function addItem()
{
    table = document.getElementsByTagName("table")[0];

    var row = table.insertRow(-1);

    var cancel = row.insertCell(-1);
    var add = row.insertCell(-1);
    var name = row.insertCell(-1);
    var qty = row.insertCell(-1);
    var desc = row.insertCell(-1);
    var status = row.insertCell(-1);
    row.insertCell(-1);
    row.insertCell(-1);

    cancel.innerHTML = '<button class="btn btn-danger" type="button" onclick="location.reload()">Cancel</button>';
    add.innerHTML = '<form method="post" action="" name="addItemForm" id="addItem"> <input type="submit" class="btn btn-primary" name="addItem" value="Add Item"/> </form>';
    name.innerHTML = '<input class="form-control" type="text" form="addItem" name="itemName" required/>';
    qty.innerHTML = '<input class="form-control" type="number" form="addItem" name="itemQty" required/>';
    desc.innerHTML = '<input class="form-control" type="text" form="addItem" name="itemDesc" required/>';
    status.innerHTML = '<select class="form-control" form="addItem" id="status" name="itemStatus"> <option value="In repair">In Repair</option> <option value="Available">Available</option></select>';

}