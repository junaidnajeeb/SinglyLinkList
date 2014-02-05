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


require_once(dirname(__FILE__) . '/../library/Node.php');

/**
 * @author Junaid Najeeb
 * @link https://github.com/junaidnajeeb/LinkList
 */
class LinkedList {

	private $head;
	private $tail;
	private $size;

	function __construct() {
		$this->head = null;
		$this->tail = null;
		$this->size = 0;
	}

	public function insertHead($data) {
		$link = new Node($data);
		$link->next = $this->head;
		$this->head = &$link;

		if ($this->tail == null) {
			$this->tail = &$link;
		}

		$this->size++;
	}

	public function isEmpty() {

		return ($this->head == null);
	}

	public function size() {
		return $this->size;
	}

	public function insertTail($data) {

		if ($this->head == null) {
			$this->insertHead($data);
		} else {
			$link = new Node($data);
			$link->next = null;
			$this->tail->next = $link;
			$this->tail = &$link;
			$this->size++;
		}
	}

	public function listToArray() {
		$array_list = array();
		$current = $this->head;

		while ($current != null) {
			$array_list[] = $current->data;
			$current = $current->next;
		}

		unset($current);

		return $array_list;
	}

	public function find($item) {
		if ($this->isEmpty()) {
			return false;
		}

		$current = $this->head;

		while ($current != null) {

			if ($current->data == $item) {
				return $current;
			}
			$current = $current->next;
		}

		return false;
	}

	public function deleteHead() {

		if ($this->isEmpty()) {
			return true;
		}

		$deleted_node = $this->head;
		$this->head = $this->head->next;

		if ($this->head == null) {
			$this->size = 0;
		} else {
			$this->size--;
		}

		unset($deleted_node);
		return true;
	}

	public function deleteTail() {

		if ($this->isEmpty()) {
			return true;
		}

		if ($this->head->next == null) {
			$this->head = null;
			$this->tail = null;
			$this->size--;
		} else {

			$previous = $this->head;
			$current = $this->head->next;

			while ($current->next != null) {
				$previous = $current;
				$current = $current->next;
			}
			$previous->next = null;
			unset($current);
			$this->size--;
		}
	}

	public function deleteByValue($item) {

		// if empty then return
		if ($this->isEmpty()) {
			return false;
		}

		// if item not in list return
		if ($this->find($item) == false) {
			return false;
		}

		$previous = $this->head;
		$current = $this->head;


		while ($current != null) {
			if ($current->data == $item) {
				if ($current == $this->head) {
					$this->head = $this->head->next;
					if ($this->head != null) {
						$this->size--;
					}
				} else if ($current == $this->tail) {
					$previous->next = null;
					unset($current);
					$this->size--;
				} else {
					$previous->next = $current->next;
					unset($current);
					$this->size--;
				}
			} else {
				$previous = $current;
				$current = $current->next;
			}
		}
	}
	
	public function reverseList() {
		// if empty then return
		if ($this->isEmpty()) {
			return true;
		}
		
		// just one element, nothing to do
		if ($this->head->next == null) {
			return true;
		}
		
		 $current = $this->head;
         $new = null;
		 $temp = null;
		 while($current != null) {
			 $temp = $current->next;
			 $current->next = $new;
			 $new = $current;
			 $current = $temp;
		 }
		 $this->head = $new;
		 
		 return true;
	}

}
