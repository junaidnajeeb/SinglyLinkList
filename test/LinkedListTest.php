<?php

/*
  Copyright (c) 2010, Junaid Najeeb All rights reserved.

  Redistribution and use in source and binary forms, with or
  without modification, are permitted provided that the following
  conditions are met:

 * Redistributions of source code must retain the above copyright
  notice, this list of conditions and the following disclaimer.

 * Redistributions in binary form must reproduce the above
  copyright notice, this list of conditions and the following
  disclaimer in the documentation and/or other materials provided
  with the distribution.

 * Neither the name of the origanization nor the names of its
  contributors may be used to endorse or promote products derived
  from this software without specific prior written permission.

  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND
  CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
  INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
  OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
  ARE DISCLAIMED.  IN NO EVENT SHALL THE COPYRIGHT HOLDER OR
  CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
  SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
  LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
  LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
  CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
  STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
  ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
  ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

require_once(dirname(__FILE__) . '/../library/LinkedList.php');

/**
 * @author Junaid Najeeb
 * @link https://github.com/junaidnajeeb/LinkList
 */
class LinkedListTest extends PHPUnit_Framework_TestCase {

	public function testInsertHead() {
		$link_list = new LinkedList();

		$link_list->insertHead(1);
		$link_list->insertHead(2);
		$link_list->insertHead(3);
		$link_list->insertHead(4);
		$link_list->insertHead(5);

		$this->assertEquals(5, $link_list->size());
	}

	public function testIsEmpty() {
		$link_list = new LinkedList();

		$this->assertTrue($link_list->isEmpty());

		$link_list->insertHead(1);
		$this->assertFalse($link_list->isEmpty());
	}

	public function testSize() {
		$link_list = new LinkedList();

		$link_list->insertHead(1);
		$this->assertEquals(1, $link_list->size());

		$link_list->insertHead(2);
		$this->assertEquals(2, $link_list->size());
	}

	public function testInsertTail() {
		$link_list = new LinkedList();

		$link_list->insertTail(1);
		$link_list->insertTail(2);
		$link_list->insertTail(3);
		$link_list->insertTail(4);
		$link_list->insertTail(5);

		$this->assertEquals(5, $link_list->size());
	}

	public function testListToArray() {
		$link_list = new LinkedList();
		$link_list->insertHead(2);
		$link_list->insertHead(1);


		$array_list = $link_list->listToArray();

		$this->assertEquals(2, count($array_list));

		$this->assertEquals(1, $array_list[0]);
		$this->assertEquals(2, $array_list[1]);
	}

	public function testFind() {

		$link_list = new LinkedList();
		$link_list->insertHead(2);
		$link_list->insertHead(1);

		$item = $link_list->find(3);

		$this->assertFalse($item);

		$obj = $link_list->find(2);

		$this->assertTrue(($obj instanceof Node));
	}

	public function testDeleteHead() {
		$link_list = new LinkedList();
		$link_list->insertHead(1);
		$link_list->insertHead(2);

		$this->assertEquals(2, $link_list->size());

		$link_list->deleteHead();
		$this->assertEquals(1, $link_list->size());

		$link_list->deleteHead();
		$this->assertEquals(0, $link_list->size());

		// empty list, delete head will have no effect.
		$link_list->deleteHead();
		$this->assertEquals(0, $link_list->size());
	}

	public function testDeleteTail() {
		$link_list = new LinkedList();
		$link_list->insertHead(1);
		$link_list->insertTail(2);
	}

	public function testDeleteByValue() {

		$link_list = new LinkedList();

		// delete empty
		$result = $link_list->deleteByValue(3);
		$this->assertFalse($result);

		// delete non existing value
		$link_list->insertHead(1);
		$result = $link_list->deleteByValue(3);
		$this->assertFalse($result);


		// delete head 
		$result = $link_list->deleteByValue(1);
		$this->assertEquals(0, $link_list->size());


		// delete tail
		$link_list->insertHead(1);
		$link_list->insertTail(2);
		$link_list->insertTail(3);

		$result = $link_list->deleteByValue(3);
		$this->assertEquals(2, $link_list->size());
		$array_list = $link_list->listToArray();
		$this->assertEquals(1, $array_list[0]);
		$this->assertEquals(2, $array_list[1]);

		// delete any
		unset($link_list);
		$link_list = new LinkedList();
		$link_list->insertHead(1);
		$link_list->insertTail(2);
		$link_list->insertTail(3);

		$result = $link_list->deleteByValue(2);
		$array_list = $link_list->listToArray();
		$this->assertEquals(1, $array_list[0]);
		$this->assertEquals(3, $array_list[1]);
	}

	public function testReverseList() {
		
		$link_list = new LinkedList();
		$link_list->insertHead(1);
		$link_list->insertTail(2);
		$link_list->insertTail(3);
		
		$link_list->reverseList();
		
		$array_list = $link_list->listToArray();
		$this->assertEquals(3, $array_list[0]);
		$this->assertEquals(2, $array_list[1]);
		$this->assertEquals(1, $array_list[2]);
		
	}

}
