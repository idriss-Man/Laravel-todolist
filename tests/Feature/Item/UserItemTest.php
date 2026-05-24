<?php
use App\Models\User;
use App\Models\Item;
use Spatie\Permission\Models\Role;

describe('F2 - Items', function () {
    beforeEach(function () {
        $this->role1= Role::create(['name' => 'todolist_manager']);
        $this->role2= Role::create(['name' => 'todolist_user']);
        $this->user1 = User::factory()->create()->assignRole('todolist_manager');
        $this->user2 = User::factory()->create()->assignRole('todolist_user');
        $this->item1 = Item::factory()->create([
            'user_id'=> $this->user1->id,
            'text'=>"My item",
            'done'=>false,
            'deadline'=>"06/02/2030",

        ]);


    });

    it('user can view items - B of BREAD', function () {
        $this->actingAs($this->user1);
        $this->get(route('dashboard.index'));
        expect(Item::where('user_id', $this->user1->id)->get()[0]->text)->toBeString('My item');
    });

    it('user can add an item - A of BREAD', function () {
        $this->actingAs($this->user1);
        $this->post(route('items.store'),[
            'text'=>"My new item",
            'deadline'=> "12/04/2030",
        ]);

        $this->assertDatabaseHas('items', [
            'text'=>"My new item",
            'user_id'=>$this->user1->id,
            'deadline'=>"12/04/2030",
        ]);

    });

    it('user can add an item to an other- A of BREAD', function () {
        $this->actingAs($this->user2);
        $this->post(route('items.store'),[
            'text'=>"His new item",
            'deadline'=> "12/04/2030",
            'user_id'=>$this->user2->id,
        ]);
        $this->assertDatabaseHas('items', [
            'text'=>"His new item",
            'user_id'=>$this->user2->id,
            'deadline'=>"12/04/2030",
        ]);

    });


    it('user can set to done an item - E of BREAD', function () {
        $this->actingAs($this->user1);
        $this->get(route('items.check',$this->item1->id));

        $this->assertDatabaseHas('items', [
            'id'=>$this->item1->id,
            'done'=>true,
        ]);


    });
    it('user can delete a done item - D of BREAD', function () {
        $this->actingAs($this->user1);

        $this->item2 = Item::factory()->create([
            'user_id'=> $this->user1->id,
            'text'=>"My second item",
            'done'=>true,
            'deadline'=>"06/05/2030",

        ]);

        $this->delete(route('items.check',$this->item2->id));

        $this->assertDatabaseMissing('items', [
            'text'=>"My second item",
            'deadline'=> "12/05/2030",
            'user_id'=>$this->user1->id,
        ]);
    });

});
